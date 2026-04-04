<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EmployerRepository
{
    public function getApplicationsQuery(Employer $employer): Builder
    {
        return Application::with(['user', 'job'])
            ->whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            });
    }

    public function filterApplicationsByStatus(Builder $query, string $status): Builder
    {
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        return $query;
    }

    public function filterApplicationsByJob(Builder $query, string $jobId): Builder
    {
        if ($jobId !== 'all') {
            $query->where('job_id', $jobId);
        }

        return $query;
    }

    public function filterApplicationsByDateRange(Builder $query, ?string $dateFrom, ?string $dateTo): Builder
    {
        if ($dateFrom) {
            $query->where('applied_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('applied_at', '<=', $dateTo.' 23:59:59');
        }

        return $query;
    }

    public function filterApplicationsByCandidate(Builder $query, string $search): Builder
    {
        return $query->whereHas('user', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        });
    }

    public function sortApplications(Builder $query, string $sortBy, string $sortOrder): Builder
    {
        $allowedSorts = ['applied_at', 'status', 'updated_at'];

        if (in_array($sortBy, $allowedSorts)) {
            return $query->orderBy($sortBy, $sortOrder);
        }

        return $query->orderBy('applied_at', 'desc');
    }

    public function getApplicationsStatistics(Employer $employer): array
    {
        $baseQuery = Application::whereHas('job', function ($q) use ($employer) {
            $q->where('employer_id', $employer->id);
        });

        return [
            'total' => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'interviewed' => (clone $baseQuery)->where('status', 'interviewed')->count(),
            'accepted' => (clone $baseQuery)->where('status', 'accepted')->count(),
            'rejected' => (clone $baseQuery)->where('status', 'rejected')->count(),
        ];
    }

    public function getEmployerJobs(Employer $employer): Collection
    {
        return $employer->jobs()->select('id', 'title')->get();
    }

    public function getEmployerDashboardStats(Employer $employer): array
    {
        $applicationsQuery = Application::whereHas('job', function ($q) use ($employer) {
            $q->where('employer_id', $employer->id);
        });

        return [
            'active_jobs' => $employer->jobs()->where('is_active', true)->count(),
            'total_applications' => (clone $applicationsQuery)->count(),
            'pending_applications' => (clone $applicationsQuery)->where('status', 'pending')->count(),
            'interviews_scheduled' => (clone $applicationsQuery)->where('status', 'interviewed')->count(),
        ];
    }

    public function getRecentApplications(Employer $employer, int $limit = 5): Collection
    {
        return Application::with(['user', 'job'])
            ->whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })
            ->orderBy('applied_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function getPopularJobs(Employer $employer, int $limit = 5): Collection
    {
        return Job::where('employer_id', $employer->id)
            ->withCount('applications')
            ->orderBy('applications_count', 'desc')
            ->take($limit)
            ->get();
    }

    public function canAccessApplication(Employer $employer, Application $application): bool
    {
        return $application->job->employer_id === $employer->id;
    }

    public function updateApplicationStatus(Application $application, string $status, ?string $notes = null): bool
    {
        return $application->update([
            'status' => $status,
            'employer_notes' => $notes,
        ]);
    }
}
