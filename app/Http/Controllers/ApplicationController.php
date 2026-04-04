<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Job;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function __construct(
        private ApplicationService $applicationService
    ) {}

    public function store(StoreApplicationRequest $request, Job $job)
    {
        try {
            $this->applicationService->createApplication(
                Auth::user(),
                $job,
                $request->validated()
            );

            return back()->with('success', 'Candidatura enviada exitosamente! El empleador revisará tu solicitud.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $applications = $this->applicationService->getUserApplications($user, $request);
        $stats = $this->applicationService->getUserApplicationsStatistics($user);
        $companies = $this->applicationService->getUserCompanies($user);

        return view('applications.index', compact('applications', 'stats', 'companies'));
    }

    public function show(Application $application)
    {
        if (! $this->applicationService->canUserAccessApplication(Auth::user(), $application)) {
            abort(403);
        }

        return view('applications.show', compact('application'));
    }

    public function destroy(Application $application)
    {
        try {
            $this->applicationService->cancelApplication(Auth::user(), $application);

            return back()->with('success', 'Candidatura cancelada exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
