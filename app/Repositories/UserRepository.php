<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\Job;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function getUserCandidateStatistics(User $user): array
    {
        return [
            'applied_jobs' => $user->applications()->count(),
            'interviews' => $user->applications()->where('status', 'interviewed')->count(),
            'saved_jobs' => $user->savedJobs()->count(),
            'accepted_applications' => $user->applications()->where('status', 'accepted')->count(),
            'profile_views' => 156, // TODO: Implement real profile view tracking
        ];
    }

    public function getRecentApplications(User $user, int $limit = 3): Collection
    {
        return $user->applications()
            ->with(['job.employer'])
            ->latest('applied_at')
            ->take($limit)
            ->get();
    }

    public function getRecentSavedJobs(User $user, int $limit = 3): Collection
    {
        return $user->savedJobs()
            ->with(['job.employer', 'job.tags'])
            ->latest('saved_at')
            ->take($limit)
            ->get();
    }

    public function getUserInterestTags(User $user): SupportCollection
    {
        // Get tags from applied jobs
        $appliedJobTags = $user->applications()
            ->with('job.tags')
            ->get()
            ->pluck('job.tags')
            ->flatten()
            ->pluck('name')
            ->unique();

        // Get tags from saved jobs
        $savedJobTags = $user->savedJobs()
            ->with('job.tags')
            ->get()
            ->pluck('job.tags')
            ->flatten()
            ->pluck('name')
            ->unique();

        return $appliedJobTags->merge($savedJobTags)->unique();
    }

    public function getRecommendedJobs(User $user, SupportCollection $interestTags, int $limit = 3): Collection
    {
        $query = Job::with(['employer', 'tags'])
            ->where(function ($q) use ($user) {
                // Exclude applied jobs
                $appliedJobIds = $user->applications()->pluck('job_id');
                if ($appliedJobIds->isNotEmpty()) {
                    $q->whereNotIn('id', $appliedJobIds);
                }

                // Exclude saved jobs
                $savedJobIds = $user->savedJobs()->pluck('job_id');
                if ($savedJobIds->isNotEmpty()) {
                    $q->whereNotIn('id', $savedJobIds);
                }
            });

        if ($interestTags->isNotEmpty()) {
            $query->whereHas('tags', function ($q) use ($interestTags) {
                $q->whereIn('name', $interestTags);
            });
        } else {
            // If no interests, show featured or recent jobs
            $query->where(function ($q) {
                $q->where('featured', true)
                    ->orWhere('urgent', true)
                    ->orWhere('created_at', '>=', now()->subDays(7));
            });
        }

        return $query->latest()->take($limit)->get();
    }

    public function getFallbackRecommendedJobs(User $user, Collection $excludeIds, int $needed): Collection
    {
        return Job::with(['employer', 'tags'])
            ->where(function ($query) use ($user, $excludeIds) {
                // Exclude applied jobs
                $appliedJobIds = $user->applications()->pluck('job_id');
                if ($appliedJobIds->isNotEmpty()) {
                    $query->whereNotIn('id', $appliedJobIds);
                }

                // Exclude saved jobs
                $savedJobIds = $user->savedJobs()->pluck('job_id');
                if ($savedJobIds->isNotEmpty()) {
                    $query->whereNotIn('id', $savedJobIds);
                }

                // Exclude already recommended jobs
                if ($excludeIds->isNotEmpty()) {
                    $query->whereNotIn('id', $excludeIds);
                }
            })
            ->latest()
            ->take($needed)
            ->get();
    }

    public function hasAppliedToJob(User $user, Job $job): bool
    {
        return $user->hasAppliedTo($job);
    }

    public function hasSavedJob(User $user, Job $job): bool
    {
        return $user->hasSaved($job);
    }

    public function saveJob(User $user, Job $job): SavedJob
    {
        return $user->savedJobs()->create([
            'job_id' => $job->id,
            'saved_at' => now(),
        ]);
    }

    public function unsaveJob(User $user, Job $job): bool
    {
        return $user->savedJobs()->where('job_id', $job->id)->delete() > 0;
    }

    public function createEmployerProfile(User $user, array $data): void
    {
        $user->employer()->create($data);
    }

    public function storeEmployerLogo($file): string
    {
        return $file->store('logos', 'public');
    }

    public function updateNotificationPreferences(User $user, array $preferences): void
    {
        $user->updateNotificationPreferences($preferences);
    }

    public function getNotificationPreferences(User $user): array
    {
        return $user->getNotificationPreferences();
    }

    public function shouldReceiveNotification(User $user, string $type): bool
    {
        return $user->shouldReceiveNotification($type);
    }

    public function getCandidatesWithRecentActivity(int $days = 30, int $limit = 10): Collection
    {
        return User::where('role', 'candidate')
            ->where(function ($query) use ($days) {
                $query->whereHas('applications', function ($q) use ($days) {
                    $q->where('applied_at', '>=', now()->subDays($days));
                })
                    ->orWhereHas('savedJobs', function ($q) use ($days) {
                        $q->where('saved_at', '>=', now()->subDays($days));
                    });
            })
            ->withCount(['applications', 'savedJobs'])
            ->take($limit)
            ->get();
    }

    public function getEmployersWithRecentJobs(int $days = 30, int $limit = 10): Collection
    {
        return User::where('role', 'employer')
            ->whereHas('employer.jobs', function ($query) use ($days) {
                $query->where('created_at', '>=', now()->subDays($days));
            })
            ->with(['employer'])
            ->withCount(['employer.jobs'])
            ->take($limit)
            ->get();
    }

    public function getUserActivitySummary(User $user): array
    {
        $recentApplications = $user->applications()
            ->where('applied_at', '>=', now()->subDays(30))
            ->count();

        $recentSaves = $user->savedJobs()
            ->where('saved_at', '>=', now()->subDays(30))
            ->count();

        $lastActivity = null;
        $lastApplication = $user->applications()->latest('applied_at')->first();
        $lastSave = $user->savedJobs()->latest('saved_at')->first();

        if ($lastApplication && $lastSave) {
            $lastActivity = $lastApplication->applied_at->gt($lastSave->saved_at)
                ? $lastApplication->applied_at
                : $lastSave->saved_at;
        } elseif ($lastApplication) {
            $lastActivity = $lastApplication->applied_at;
        } elseif ($lastSave) {
            $lastActivity = $lastSave->saved_at;
        }

        return [
            'recent_applications' => $recentApplications,
            'recent_saves' => $recentSaves,
            'last_activity' => $lastActivity,
            'is_active' => $lastActivity && $lastActivity->gte(now()->subDays(7)),
        ];
    }

    /**
     * Get employer-specific statistics
     */
    public function getUserEmployerStatistics(User $user): array
    {
        $employer = $user->employer;

        return [
            'active_jobs' => $employer->jobs()->where('is_active', true)->count(),
            'total_applications' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->count(),
            'pending_applications' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->where('status', 'pending')->count(),
            'interviews_scheduled' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->where('status', 'interviewed')->count(),
        ];
    }

    /**
     * Get recent applications for employer's jobs
     */
    public function getRecentApplicationsForEmployer(User $user, int $limit = 5): Collection
    {
        $employer = $user->employer;

        return Application::with(['user', 'job'])
            ->whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })
            ->orderBy('applied_at', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Get most popular jobs for employer (by application count)
     */
    public function getPopularJobsForEmployer(User $user, int $limit = 5): Collection
    {
        $employer = $user->employer;

        return Job::where('employer_id', $employer->id)
            ->withCount('applications')
            ->orderBy('applications_count', 'desc')
            ->take($limit)
            ->get();
    }
}
