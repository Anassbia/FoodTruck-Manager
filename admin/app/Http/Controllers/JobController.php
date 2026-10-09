<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job' => 'required|string|max:255'
        ]);

        $job = Job::create($validated);
        return response()->json($job, 201);
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return response()->json($job);
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $validated = $request->validate([
            'job' => 'required|string|max:255'
        ]);

        $job->update($validated);
        return response()->json($job);
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return response()->json(null, 204);
    }
}
