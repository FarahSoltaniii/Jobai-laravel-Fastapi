<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = [
        'user_id',
        'experience_years',
        'degree',
        'job_title',
        'city',
        'skill',
        'predicted_salary'
    ];
}