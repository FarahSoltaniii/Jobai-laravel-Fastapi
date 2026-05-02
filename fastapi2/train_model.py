import pickle
from pathlib import Path

import pandas as pd
from sklearn.compose import ColumnTransformer
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_absolute_error, r2_score
from sklearn.model_selection import train_test_split
from sklearn.pipeline import Pipeline
from sklearn.preprocessing import OneHotEncoder

DATA_PATH = Path("data/salaries.csv")
MODEL_PATH = Path("salary_model.pkl")
FEATURES = ["experience_years", "degree", "job_title", "city", "skill"]


def load_dataset() -> pd.DataFrame:
    df = pd.read_csv(DATA_PATH)
    return df.dropna()


def build_pipeline() -> Pipeline:
    categorical_features = ["degree", "job_title", "city", "skill"]
    numeric_features = ["experience_years"]

    preprocessor = ColumnTransformer(
        transformers=[
            ("cat", OneHotEncoder(handle_unknown="ignore"), categorical_features),
            ("num", "passthrough", numeric_features),
        ]
    )

    model = RandomForestRegressor(
        n_estimators=300,
        max_depth=12,
        min_samples_split=2,
        min_samples_leaf=1,
        random_state=42,
    )

    return Pipeline([("preprocessor", preprocessor), ("model", model)])


def main():
    df = load_dataset()
    X = df[FEATURES]
    y = df["salary"]
    pipeline = build_pipeline()

    X_train, X_test, y_train, y_test = train_test_split(
        X, y, test_size=0.2, random_state=42
    )

    pipeline.fit(X_train, y_train)
    predictions = pipeline.predict(X_test)

    mae = mean_absolute_error(y_test, predictions)
    r2 = r2_score(y_test, predictions)

    print("Entrainement termine")
    print(f"MAE: {mae:.2f}")
    print(f"R2: {r2:.2f}")

    with open(MODEL_PATH, "wb") as file_handle:
        pickle.dump(pipeline, file_handle)

    print(f"Modele sauvegarde dans : {MODEL_PATH}")


if __name__ == "__main__":
    main()
