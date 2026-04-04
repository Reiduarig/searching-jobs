<?php

namespace App\Services;

use App\Mail\NewApplicationNotification;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ApplicationService
{
    private const APPLICATIONS_PER_PAGE = 10;

    public function __construct(
        private ApplicationRepository $applicationRepository
    ) {}

    public function createApplication(User $user, Job $job, array $validatedData): Application
    {
        $this->validateUserCanApply($user, $job);

        // Handle CV upload if provided
        $cvPath = null;
        if (isset($validatedData['cv_file'])) {
            $cvPath = $this->applicationRepository->storeCV($validatedData['cv_file']);
        }

        // Create application
        $application = $this->applicationRepository->create([
            'user_id' => $user->id,
            'job_id' => $job->id,
            'cover_letter' => $validatedData['cover_letter'] ?? null,
            'cv_path' => $cvPath,
            'applied_at' => now(),
        ]);

        // Send notification email
        $this->sendApplicationNotification($application);

        return $application;
    }

    public function getUserApplications(User $user, Request $request): LengthAwarePaginator
    {
        $query = $this->applicationRepository->getUserApplicationsQuery($user);

        // Apply filters
        if ($request->filled('status')) {
            $query = $this->applicationRepository->filterByStatus($query, $request->status);
        }

        if ($request->filled('company')) {
            $query = $this->applicationRepository->filterByCompany($query, $request->company);
        }

        if ($request->filled('job_title')) {
            $query = $this->applicationRepository->filterByJobTitle($query, $request->job_title);
        }

        if ($request->filled('date_from') || $request->filled('date_to')) {
            $query = $this->applicationRepository->filterByDateRange(
                $query,
                $request->date_from,
                $request->date_to
            );
        }

        if ($request->filled('date_range') && $request->date_range !== 'all') {
            $query = $this->applicationRepository->filterByPredefinedDateRange($query, $request->date_range);
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'applied_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query = $this->applicationRepository->sortApplications($query, $sortBy, $sortOrder);

        return $query->paginate(self::APPLICATIONS_PER_PAGE)->appends($request->query());
    }

    public function getUserApplicationsStatistics(User $user): array
    {
        return $this->applicationRepository->getUserApplicationsStatistics($user);
    }

    public function getUserCompanies(User $user)
    {
        return $this->applicationRepository->getUserCompanies($user);
    }

    public function canUserAccessApplication(User $user, Application $application): bool
    {
        return $this->applicationRepository->canUserAccessApplication($user, $application);
    }

    public function cancelApplication(User $user, Application $application): bool
    {
        if (! $this->canUserAccessApplication($user, $application)) {
            throw new \Exception('No tienes permiso para acceder a esta aplicación.');
        }

        if (! $this->applicationRepository->canCancelApplication($application)) {
            throw new \Exception('No puedes cancelar esta candidatura.');
        }

        return $this->applicationRepository->deleteApplication($application);
    }

    public function getJobApplicationsStatistics(Job $job): array
    {
        return $this->applicationRepository->getApplicationsCountByStatus($job);
    }

    public function getRecentApplicationsForJob(Job $job, int $limit = 5)
    {
        return $this->applicationRepository->getRecentApplicationsForJob($job, $limit);
    }

    private function validateUserCanApply(User $user, Job $job): void
    {
        if ($user->isEmployer()) {
            throw new \Exception('Los empleadores no pueden aplicar a trabajos.');
        }

        if ($this->applicationRepository->hasUserAppliedToJob($user, $job)) {
            throw new \Exception('Ya has aplicado a este trabajo.');
        }
    }

    private function sendApplicationNotification(Application $application): void
    {
        try {
            Mail::to($application->job->employer->user->email)
                ->send(new NewApplicationNotification($application));
        } catch (\Exception $e) {
            // Log error but don't fail the application
            Log::error('Error enviando email de nueva candidatura: '.$e->getMessage());
        }
    }
}
