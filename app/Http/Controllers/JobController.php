<?php

namespace App\Http\Controllers;

use App\Events\JobCreatedEvent;
use App\Http\Requests\StoreJobRequest;
use App\Http\Resources\JobResource;
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
        return response()->json([
            'status' => 'success',
            'data'   => JobResource::collection(Job::latest()->paginate(10)),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $job = Job::create($request->validated());

        SyncJobToElasticsearch::dispatchAfterResponse($job);
        event(new JobCreatedEvent($job));
        return response()->json([
            'status'  => 'success',
            'message' => 'Job created successfully!',
            'data'    => new JobResource($job),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return response()->json([
            'status' => 'success',
            'data'   => new JobResource($job),
        ]);
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
