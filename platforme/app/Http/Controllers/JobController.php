<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // ✅ correct
use App\Models\Job;          // ✅ correct

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        return view('jobs', compact('jobs'));
    }

    public function create()
    {
        return view('admin.create-job');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'city' => 'required',
            'email' => 'required|email',
            'description' => 'required'
        ]);

        Job::create($request->all());

        return redirect('/jobs')->with('success', 'Job ajouté avec succès');
    }
}