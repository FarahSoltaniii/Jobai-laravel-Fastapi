<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\PredictionController;

Route::get('/', [PredictionController::class, 'index']);
Route::post('/predict', [PredictionController::class, 'predict']);
Route::get('/history', [PredictionController::class, 'history']);
use App\Http\Controllers\JobController;

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/admin/jobs/create', [JobController::class, 'create']);
Route::post('/admin/jobs/store', [JobController::class, 'store']);
Route::get('/', [JobController::class, 'index']); // accueil


// afficher formulaire (GET)
Route::get('/predict', function () {
    return view('welcome');
});
