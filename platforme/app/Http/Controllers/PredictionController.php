<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Prediction;

class PredictionController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function predict(Request $request)
    {
        $request->validate([
            'experience_years' => 'required|numeric',
            'degree' => 'required',
            'job_title' => 'required',
            'city' => 'required',
            'skill' => 'required'
        ]);

        $payload = [
            'experience_years' => (float) $request->experience_years,
            'degree' => $request->degree,
            'job_title' => $request->job_title,
            'city' => $request->city,
            'skill' => $request->skill,
        ];

        $fastApiUrl = env('FASTAPI_URL', 'http://127.0.0.1:8001');

        try {
            $response = Http::timeout(15)->post($fastApiUrl . '/api/predict', $payload);
        } catch (\Throwable $e) {
            Log::error('FastAPI request failed', [
                'url' => $fastApiUrl,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['api' => "Impossible de joindre FastAPI sur {$fastApiUrl}."]);
        }

        if (! $response->successful()) {
            Log::error('FastAPI returned HTTP error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['api' => 'FastAPI a retourne une erreur interne.']);
        }

        $data = $response->json();

        if (! ($data['ok'] ?? false)) {
            $errors = $data['errors'] ?? ['Prediction impossible avec les valeurs envoyees.'];

            return back()
                ->withInput()
                ->withErrors(['api' => implode(' ', $errors)]);
        }

        $salary = $data['prediction'] ?? null;

        if ($salary === null) {
            return back()
                ->withInput()
                ->withErrors(['api' => 'La reponse de FastAPI ne contient pas de prediction.']);
        }

        Prediction::create([
            'user_id' => null,
            'experience_years' => $request->experience_years,
            'degree' => $request->degree,
            'job_title' => $request->job_title,
            'city' => $request->city,
            'skill' => $request->skill,
            'predicted_salary' => $salary,
        ]);

        return view('result', compact('salary'));
    }

   public function history()
{
    // regrouper par job_title + moyenne salaire
    $predictions = Prediction::select('job_title')
        ->selectRaw('AVG(predicted_salary) as avg_salary')
        ->groupBy('job_title')
        ->get();

    // données pour chart
    $labels = $predictions->pluck('job_title');
    $salaries = $predictions->pluck('avg_salary');

    return view('history', compact('predictions', 'labels', 'salaries'));
}
}
