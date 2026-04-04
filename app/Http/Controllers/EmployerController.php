<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateApplicationStatusRequest;
use App\Models\Application;
use App\Services\EmployerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    public function __construct(
        private EmployerService $employerService
    ) {}

    public function applications(Request $request)
    {
        $employer = Auth::user()->employer;

        $applications = $this->employerService->getFilteredApplications($employer, $request);
        $stats = $this->employerService->getApplicationsStatistics($employer);
        $jobs = $this->employerService->getEmployerJobs($employer);

        return view('employer.applications.index', compact('applications', 'stats', 'jobs'));
    }

    public function showApplication(Application $application)
    {
        $employer = Auth::user()->employer;

        if (! $this->employerService->canAccessApplication($employer, $application)) {
            abort(403);
        }

        return view('employer.applications.show', compact('application'));
    }

    public function updateApplicationStatus(UpdateApplicationStatusRequest $request, Application $application)
    {
        $employer = Auth::user()->employer;

        if (! $this->employerService->canAccessApplication($employer, $application)) {
            abort(403);
        }

        $validated = $request->validated();

        $this->employerService->updateApplicationStatus(
            $application,
            $validated['status'],
            $validated['notes'] ?? null
        );

        $message = $this->employerService->getStatusMessage($validated['status']);

        return back()->with('success', $message);
    }

    public function dashboard()
    {
        $employer = Auth::user()->employer;
        $dashboardData = $this->employerService->getDashboardData($employer);

        return view('employer.dashboard', $dashboardData);
    }
}
