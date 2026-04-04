<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct(
        private JobService $jobService
    ) {}

    public function index()
    {
        $featuredJobs = $this->jobService->getFeaturedJobs();
        $jobs = $this->jobService->getRecentJobs();
        $tags = $this->jobService->getAllTags();

        return view('jobs.index', compact('featuredJobs', 'jobs', 'tags'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(StoreJobRequest $request)
    {
        $validated = $request->validated();
        $job = $this->createJob($validated);
        $this->jobService->attachTagsToJob($job, $validated['tags'] ?? null);

        return redirect('/')->with('success', 'Trabajo creado exitosamente.');
    }

    public function show(Job $job)
    {
        $job = $this->jobService->getJobWithRelations($job);
        $user = Auth::user();

        $hasApplied = $this->jobService->checkUserApplicationStatus($job, $user);
        $isSaved = $this->jobService->checkUserSavedStatus($job, $user);
        $relatedJobs = $this->jobService->getRelatedJobs($job);

        return view('jobs.show', compact('job', 'hasApplied', 'isSaved', 'relatedJobs'));
    }

    public function edit(Job $job)
    {
        //
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    public function destroy(Job $job)
    {
        //
    }

    private function createJob(array $validated): Job
    {
        return Auth::user()->employer->jobs()->create(
            Arr::except($validated, 'tags')
        );
    }
}
