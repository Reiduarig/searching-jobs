<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class JobController extends Controller
{

    public function index()
    {
        $jobs = Job::latest()
        ->with(['employer','tags'])    
        ->get()
            ->groupBy('featured');

        return view('jobs.index',[
            'featuredJobs' => $jobs[1] ?? [],
            'jobs' => $jobs[0] ?? [],
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0', 'gte:salary_min'],
            'salary_period' => ['required', 'string', Rule::in(['hour', 'day', 'week', 'month', 'year'])],
            'location' => ['required', 'string', 'max:255'],
            'schedule' => ['required', 'string', Rule::in(['full-time', 'part-time', 'contract', 'internship'])],
            'experience_level' => ['nullable', 'string', Rule::in(['entry', 'mid', 'senior', 'lead'])],
            'education' => ['nullable', 'string', Rule::in(['none', 'high_school', 'bachelor', 'master', 'phd'])],
            'benefits' => ['nullable', 'array'],
            'url' => ['required', 'active_url'],
            'featured' => ['boolean'],
            'urgent' => ['boolean'],
            'duration' => ['nullable', 'integer', 'min:1'],
            'tags' => ['nullable', 'string'],
        ]);

        // Process boolean fields
        $validated['featured'] = $request->boolean('featured');
        $validated['urgent'] = $request->boolean('urgent');

        // Create the job without tags
        $job = Auth::user()->employer->jobs()->create(Arr::except($validated, 'tags'));

        // Handle tags
        if($validated['tags'] ?? false) {
            foreach(explode(',', $validated['tags']) as $tag) {
                $job->tag(trim($tag));
            }
        }

        return redirect('/')->with('success', 'Trabajo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job->load(['employer', 'tags', 'applications']);
        
        // Verificar si el usuario actual ya aplicó a este trabajo
        $hasApplied = false;
        if (Auth::check() && Auth::user()->isCandidate()) {
            $hasApplied = Auth::user()->hasAppliedTo($job);
        }
        
        // Verificar si el usuario actual tiene este trabajo guardado
        $isSaved = false;
        if (Auth::check() && Auth::user()->isCandidate()) {
            $isSaved = Auth::user()->savedJobs()->where('job_id', $job->id)->exists();
        }
        
        // Trabajos relacionados (mismas tags o mismo empleador)
        $relatedJobs = Job::where('id', '!=', $job->id)
            ->where(function($query) use ($job) {
                $query->where('employer_id', $job->employer_id)
                      ->orWhereHas('tags', function($q) use ($job) {
                          $q->whereIn('name', $job->tags->pluck('name'));
                      });
            })
            ->with(['employer', 'tags'])
            ->take(3)
            ->get();
        
        return view('jobs.show', compact('job', 'hasApplied', 'isSaved', 'relatedJobs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
