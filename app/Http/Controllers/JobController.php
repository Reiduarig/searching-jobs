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
            'salary' => ['required', 'numeric'],
            'location' => ['required', 'string', 'max:255'],
            'schedule' => ['required', 'string', Rule::in(['full-time', 'part-time', 'contract'])],
            'url' => ['required', 'active_url'],
            'featured' => ['boolean'],
            'tags' => ['nullable'],
        ]);

        $validated['featured'] = $request->has('featured');

        // Create the job without tags
        $job =Auth::user()->employer->jobs()->create(Arr::except($validated, 'tags'));

        if($validated['tags'] ?? false) {
            foreach(explode(',', $validated['tags']) as $tag) {  // Assuming tags are sent as a comma-separated string
                $job->tag(trim($tag));
            }
        }

        return redirect()->route('jobs')->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
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
