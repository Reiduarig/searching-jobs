<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Storage;

class ApplicationRepository
{
    public function getUserApplicationsQuery(User $user): Builder
    {
        return $user->applications()->getQuery()->with(['job', 'job.employer']);
    }

    public function filterByStatus(Builder $query, string $status): Builder
    {
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        return $query;
    }

    public function filterByCompany(Builder $query, string $company): Builder
    {
        return $query->whereHas('job.employer', function ($q) use ($company) {
            $q->where('name', 'like', "%{$company}%");
        });
    }

    public function filterByJobTitle(Builder $query, string $jobTitle): Builder
    {
        return $query->whereHas('job', function ($q) use ($jobTitle) {
            $q->where('title', 'like', "%{$jobTitle}%");
        });
    }

    public function filterByDateRange(Builder $query, ?string $dateFrom, ?string $dateTo): Builder
    {
        if ($dateFrom) {
            $query->where('applied_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('applied_at', '<=', $dateTo.' 23:59:59');
        }

        return $query;
    }

    public function filterByPredefinedDateRange(Builder $query, string $range): Builder
    {
        return match ($range) {
            'today' => $query->whereDate('applied_at', today()),
            'week' => $query->where('applied_at', '>=', now()->subWeek()),
            'month' => $query->where('applied_at', '>=', now()->subMonth()),
            '3months' => $query->where('applied_at', '>=', now()->subMonths(3)),
            default => $query,
        };
    }

    public function sortApplications(Builder $query, string $sortBy, string $sortOrder): Builder
    {
        $allowedSorts = ['applied_at', 'status', 'updated_at'];

        if (in_array($sortBy, $allowedSorts)) {
            return $query->orderBy($sortBy, $sortOrder);
        }

        return $query->orderBy('applied_at', 'desc');
    }

    public function getUserApplicationsStatistics(User $user): array
    {
        $applications = $user->applications();

        return [
            'total' => (clone $applications)->count(),
            'pending' => (clone $applications)->where('status', 'pending')->count(),
            'interviewed' => (clone $applications)->where('status', 'interviewed')->count(),
            'rejected' => (clone $applications)->where('status', 'rejected')->count(),
            'accepted' => (clone $applications)->where('status', 'accepted')->count(),
        ];
    }

    public function getUserCompanies(User $user): SupportCollection
    {
        return $user->applications()
            ->with('job.employer')
            ->get()
            ->pluck('job.employer.name')
            ->unique()
            ->sort()
            ->values();
    }

    public function create(array $data): Application
    {
        return Application::create($data);
    }

    public function hasUserAppliedToJob(User $user, Job $job): bool
    {
        return $user->hasAppliedTo($job);
    }

    public function canUserAccessApplication(User $user, Application $application): bool
    {
        return $application->user_id === $user->id;
    }

    public function canCancelApplication(Application $application): bool
    {
        return $application->status === 'pending';
    }

    public function deleteApplication(Application $application): bool
    {
        // Delete CV file if exists
        if ($application->cv_path) {
            Storage::disk('public')->delete($application->cv_path);
        }

        return $application->delete();
    }

    public function storeCV($file): string
    {
        return $file->store('cvs', 'public');
    }

    public function findWithRelations(int $id): ?Application
    {
        return Application::with(['user', 'job', 'job.employer'])->find($id);
    }

    public function getRecentApplicationsForJob(Job $job, int $limit = 5): Collection
    {
        return Application::with(['user'])
            ->where('job_id', $job->id)
            ->orderBy('applied_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function getApplicationsCountByStatus(Job $job): array
    {
        $applications = Application::where('job_id', $job->id);

        return [
            'total' => (clone $applications)->count(),
            'pending' => (clone $applications)->where('status', 'pending')->count(),
            'interviewed' => (clone $applications)->where('status', 'interviewed')->count(),
            'accepted' => (clone $applications)->where('status', 'accepted')->count(),
            'rejected' => (clone $applications)->where('status', 'rejected')->count(),
        ];
    }
}
