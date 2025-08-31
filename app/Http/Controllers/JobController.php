<?php

namespace App\Http\Controllers;

use App\Events\JobCreatedEvent;
use App\Jobs\SyncJobToElasticsearch;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Job::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'nullable|string|max:255',
        ]);

        $job = Job::create($data);
        SyncJobToElasticsearch::dispatchAfterResponse($job);
        JobCreatedEvent::dispatchAfterResponse($job);
        return response()->json([
            'status'  => 'success',
            'message' => 'Job created successfully!',
            'data'    => $job,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
