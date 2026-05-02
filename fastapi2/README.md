# Salary Prediction App

Application FastAPI de prediction de salaire avec interface web et endpoint JSON.

## Lancer le projet

```bash
pip install -r requirements.txt
python train_model.py
uvicorn app:app --reload
```

## Fonctionnalites

- Interface HTML propre et responsive
- Validation serveur des entrees
- Endpoint `POST /api/predict`
- Endpoint `GET /health`
- Formulaire alimente par les valeurs presentes dans `data/salaries.csv`

## Exemple JSON

```json
{
  "experience_years": 4,
  "degree": "Master",
  "job_title": "Data Scientist",
  "city": "Tunis",
  "skill": "Python"
}
```
