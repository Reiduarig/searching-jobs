<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SavedJobController extends Controller
{
    public function index(): View
    {
        $savedJobs = Auth::user()->savedJobs()
            ->with(['job.employer'])
            ->latest('saved_at')
            ->paginate(10);

        return view('saved-jobs.index', compact('savedJobs'));
    }

    public function store(Request $request, Job $job): JsonResponse
    {
        $user = Auth::user();

        if ($user->hasSaved($job)) {
            return response()->json([
                'success' => false,
                'message' => 'Este trabajo ya está en tus favoritos'
            ], 409);
        }

        $user->savedJobs()->create([
            'job_id' => $job->id,
            'saved_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Trabajo guardado en favoritos',
            'saved' => true
        ]);
    }

    public function destroy(Job $job): JsonResponse
    {
        $user = Auth::user();

        $savedJob = $user->savedJobs()->where('job_id', $job->id)->first();

        if (!$savedJob) {
            return response()->json([
                'success' => false,
                'message' => 'Este trabajo no está en tus favoritos'
            ], 404);
        }

        $savedJob->delete();

        return response()->json([
            'success' => true,
            'message' => 'Trabajo eliminado de favoritos',
            'saved' => false
        ]);
    }

    public function toggle(Job $job): JsonResponse
    {
        $user = Auth::user();

        if ($user->hasSaved($job)) {
            return $this->destroy($job);
        }

        return $this->store(request(), $job);
    }
}
