import pickle
from pathlib import Path

import pandas as pd
from fastapi import FastAPI, Form, Request
from fastapi.responses import HTMLResponse
from fastapi.staticfiles import StaticFiles
from fastapi.templating import Jinja2Templates
from pydantic import BaseModel
from fastapi.middleware.cors import CORSMiddleware

# ========================
# CONFIG
# ========================
BASE_DIR = Path(__file__).resolve().parent
MODEL_PATH = BASE_DIR / "salary_model.pkl"
DATA_PATH = BASE_DIR / "data" / "salaries.csv"
STATIC_DIR = BASE_DIR / "static"
TEMPLATES_DIR = BASE_DIR / "templates"

app = FastAPI(
    title="Salary Prediction API",
    version="1.0.0",
)

@app.get("/options")
def get_options():
    return FORM_OPTIONS
# ========================
# CORS (IMPORTANT)
# ========================
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# ========================
# STATIC + TEMPLATES (optionnel)
# ========================
app.mount("/static", StaticFiles(directory=str(STATIC_DIR)), name="static")
templates = Jinja2Templates(directory=str(TEMPLATES_DIR))

# ========================
# LOAD MODEL + DATA
# ========================
with open(MODEL_PATH, "rb") as f:
    model = pickle.load(f)

dataset = pd.read_csv(DATA_PATH)

FORM_OPTIONS = {
    "degree": sorted(dataset["degree"].dropna().astype(str).unique().tolist()),
    "job_title": sorted(dataset["job_title"].dropna().astype(str).unique().tolist()),
    "city": sorted(dataset["city"].dropna().astype(str).unique().tolist()),
    "skill": sorted(dataset["skill"].dropna().astype(str).unique().tolist()),
}

# ========================
# SCHEMA
# ========================
class SalaryPredictionRequest(BaseModel):
    experience_years: float
    degree: str
    job_title: str
    city: str
    skill: str

# ========================
# UTILS
# ========================
def normalize(payload: dict):
    return {
        "experience_years": payload["experience_years"],
        "degree": payload["degree"].strip(),
        "job_title": payload["job_title"].strip(),
        "city": payload["city"].strip(),
        "skill": payload["skill"].strip(),
    }

def validate(payload: dict):
    errors = []

    if payload["experience_years"] < 0 or payload["experience_years"] > 50:
        errors.append("experience_years must be between 0 and 50")

    for f in ["degree", "job_title", "city", "skill"]:
        if not payload[f]:
            errors.append(f"{f} is required")

    for f in ["degree", "job_title", "city", "skill"]:
        if payload[f] not in FORM_OPTIONS[f]:
            errors.append(f"{f} invalid value")

    return errors

def predict_salary(payload: dict):
    df = pd.DataFrame([payload])
    pred = model.predict(df)[0]
    return round(float(pred), 2)

# ========================
# ROUTES
# ========================

# ✅ Health check
@app.get("/health")
def health():
    return {"status": "ok"}

# ✅ API pour Laravel (RECOMMANDÉ)
@app.post("/api/predict")
def api_predict(data: SalaryPredictionRequest):
    payload = normalize(data.model_dump())
    errors = validate(payload)

    if errors:
        return {"ok": False, "errors": errors}

    try:
        prediction = predict_salary(payload)
    except Exception as exc:
        return {"ok": False, "errors": [f"prediction failed: {str(exc)}"]}

    return {
        "ok": True,
        "prediction": prediction,
        "currency": "DT"
    }

# ✅ API simple (optionnel)
@app.post("/predict-salary")
def predict_simple(data: SalaryPredictionRequest):
    payload = normalize(data.model_dump())
    errors = validate(payload)

    if errors:
        return {"ok": False, "errors": errors}

    try:
        prediction = predict_salary(payload)
    except Exception as exc:
        return {"ok": False, "errors": [f"prediction failed: {str(exc)}"]}

    return {
        "predicted_salary": prediction
    }

# ========================
# HTML (optionnel)
# ========================
@app.get("/", response_class=HTMLResponse)
def home(request: Request):
    return templates.TemplateResponse("index.html", {"request": request, "options": FORM_OPTIONS})

@app.post("/predict", response_class=HTMLResponse)
def predict_form(
    request: Request,
    experience_years: float = Form(...),
    degree: str = Form(...),
    job_title: str = Form(...),
    city: str = Form(...),
    skill: str = Form(...),
):
    payload = normalize({
        "experience_years": experience_years,
        "degree": degree,
        "job_title": job_title,
        "city": city,
        "skill": skill,
    })

    errors = validate(payload)

    if errors:
        return templates.TemplateResponse("index.html", {
            "request": request,
            "errors": errors,
            "options": FORM_OPTIONS
        })

    prediction = predict_salary(payload)

    return templates.TemplateResponse("index.html", {
        "request": request,
        "prediction": prediction,
        "options": FORM_OPTIONS
    })
