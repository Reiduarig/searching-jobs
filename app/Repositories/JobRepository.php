<?php

namespace App\Repositories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class JobRepository
{
    public function getFeaturedJobs(): Collection
    {
        return Job::where('featured', true)
            ->latest()
            ->with(['employer', 'tags'])
            ->get();
    }

    public function getRecentJobs(int $perPage = 6): LengthAwarePaginator
    {
        return Job::where('featured', false)
            ->latest()
            ->with(['employer', 'tags'])
            ->paginate($perPage)
            ->fragment('trabajos-recientes');
    }

    public function getJobWithRelations(Job $job): Job
    {
        return $job->load(['employer', 'tags', 'applications']);
    }

    public function getRelatedJobs(Job $job, int $limit = 3): Collection
    {
        return Job::where('id', '!=', $job->id)
            ->where(function ($query) use ($job) {
                $query->where('employer_id', $job->employer_id)
                    ->orWhereHas('tags', function ($q) use ($job) {
                        $q->whereIn('name', $job->tags->pluck('name'));
                    });
            })
            ->with(['employer', 'tags'])
            ->take($limit)
            ->get();
    }

    public function searchJobs(array $filters = []): Builder
    {
        $query = Job::with(['employer', 'tags']);

        if (isset($filters['search']) && ! empty($filters['search'])) {
            $searchTerm = $filters['search'];
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhereHas('employer', function ($employerQuery) use ($searchTerm) {
                        $employerQuery->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        if (isset($filters['location']) && ! empty($filters['location'])) {
            $query->where('location', $filters['location']);
        }

        if (isset($filters['schedule']) && ! empty($filters['schedule'])) {
            $query->where('schedule', $filters['schedule']);
        }

        if (isset($filters['experience']) && ! empty($filters['experience'])) {
            $query->where('experience_level', $filters['experience']);
        }

        if (isset($filters['salary_range']) && ! empty($filters['salary_range'])) {
            $this->applySalaryFilter($query, $filters['salary_range']);
        }

        if (isset($filters['tags']) && ! empty($filters['tags'])) {
            $query->whereHas('tags', function ($tagQuery) use ($filters) {
                $tagQuery->whereIn('tags.id', $filters['tags']);
            });
        }

        return $query;
    }

    public function checkUserApplicationStatus(Job $job, ?User $user): bool
    {
        if (! $user || ! $user->isCandidate()) {
            return false;
        }

        return $user->hasAppliedTo($job);
    }

    public function checkUserSavedStatus(Job $job, ?User $user): bool
    {
        if (! $user || ! $user->isCandidate()) {
            return false;
        }

        return $user->savedJobs()->where('job_id', $job->id)->exists();
    }

    private function applySalaryFilter(Builder $query, string $salaryRange): void
    {
        if ($salaryRange === '100000+') {
            $query->where('salary_min', '>=', 100000);

            return;
        }

        [$min, $max] = explode('-', $salaryRange);
        $query->where(function ($q) use ($min, $max) {
            $q->whereBetween('salary_min', [(int) $min, (int) $max])
                ->orWhereBetween('salary_max', [(int) $min, (int) $max]);
        });
    }
}
