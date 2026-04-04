<?php

namespace App\Services;

use App\Models\Job;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private const RECENT_ITEMS_LIMIT = 3;

    private const RECOMMENDED_JOBS_LIMIT = 3;

    private const ACTIVITY_DAYS = 30;

    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function createUser(array $userData): User
    {
        return $this->userRepository->create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
            'role' => $userData['role'],
            'newsletter' => $userData['newsletter'] ?? false,
        ]);
    }

    public function createEmployerProfile(User $user, string $companyName, $logoFile = null): void
    {
        $logoPath = null;
        if ($logoFile) {
            $logoPath = $this->userRepository->storeEmployerLogo($logoFile);
        }

        $this->userRepository->createEmployerProfile($user, [
            'name' => $companyName,
            'logo_url' => $logoPath,
        ]);
    }

    public function getCandidateDashboardData(User $user): array
    {
        $stats = $this->userRepository->getUserCandidateStatistics($user);
        $recentApplications = $this->userRepository->getRecentApplications($user, self::RECENT_ITEMS_LIMIT);
        $savedJobs = $this->userRepository->getRecentSavedJobs($user, self::RECENT_ITEMS_LIMIT);
        $recommendedJobs = $this->getRecommendedJobsForUser($user);

        return [
            'stats' => $stats,
            'recent_applications' => $recentApplications,
            'saved_jobs' => $savedJobs,
            'recommended_jobs' => $recommendedJobs,
        ];
    }

    public function getEmployerDashboardData(User $user): array
    {
        $stats = $this->userRepository->getUserEmployerStatistics($user);
        $recentApplications = $this->userRepository->getRecentApplicationsForEmployer($user, self::RECENT_ITEMS_LIMIT);
        $popularJobs = $this->userRepository->getPopularJobsForEmployer($user, self::RECENT_ITEMS_LIMIT);

        return [
            'stats' => $stats,
            'recent_applications' => $recentApplications,
            'popular_jobs' => $popularJobs,
        ];
    }

    public function getRecommendedJobsForUser(User $user): Collection
    {
        $interestTags = $this->userRepository->getUserInterestTags($user);
        $recommendedJobs = $this->userRepository->getRecommendedJobs($user, $interestTags, self::RECOMMENDED_JOBS_LIMIT);

        // If not enough recommendations, fill with fallback jobs
        if ($recommendedJobs->count() < self::RECOMMENDED_JOBS_LIMIT) {
            $needed = self::RECOMMENDED_JOBS_LIMIT - $recommendedJobs->count();
            $fallbackJobs = $this->userRepository->getFallbackRecommendedJobs(
                $user,
                $recommendedJobs->pluck('id'),
                $needed
            );
            $recommendedJobs = $recommendedJobs->merge($fallbackJobs);
        }

        return $recommendedJobs;
    }

    public function canUserApplyToJob(User $user, Job $job): bool
    {
        if ($user->isEmployer()) {
            return false;
        }

        return ! $this->userRepository->hasAppliedToJob($user, $job);
    }

    public function canUserSaveJob(User $user, Job $job): bool
    {
        if ($user->isEmployer()) {
            return false;
        }

        return ! $this->userRepository->hasSavedJob($user, $job);
    }

    public function saveJobForUser(User $user, Job $job): bool
    {
        if (! $this->canUserSaveJob($user, $job)) {
            return false;
        }

        $this->userRepository->saveJob($user, $job);

        return true;
    }

    public function unsaveJobForUser(User $user, Job $job): bool
    {
        return $this->userRepository->unsaveJob($user, $job);
    }

    public function toggleSavedJob(User $user, Job $job): array
    {
        if ($this->userRepository->hasSavedJob($user, $job)) {
            $this->userRepository->unsaveJob($user, $job);

            return [
                'saved' => false,
                'message' => 'Trabajo eliminado de guardados',
            ];
        } else {
            $this->userRepository->saveJob($user, $job);

            return [
                'saved' => true,
                'message' => 'Trabajo guardado exitosamente',
            ];
        }
    }

    public function updateUserNotificationPreferences(User $user, array $preferences): void
    {
        $validPreferences = $this->validateNotificationPreferences($preferences);
        $this->userRepository->updateNotificationPreferences($user, $validPreferences);
    }

    public function getUserNotificationPreferences(User $user): array
    {
        return $this->userRepository->getNotificationPreferences($user);
    }

    public function shouldUserReceiveNotification(User $user, string $type): bool
    {
        return $this->userRepository->shouldReceiveNotification($user, $type);
    }

    public function getUserActivitySummary(User $user): array
    {
        return $this->userRepository->getUserActivitySummary($user);
    }

    public function getActiveUsers(?int $days = null): Collection
    {
        return $this->userRepository->getCandidatesWithRecentActivity($days ?? self::ACTIVITY_DAYS);
    }

    public function getActiveEmployers(?int $days = null): Collection
    {
        return $this->userRepository->getEmployersWithRecentJobs($days ?? self::ACTIVITY_DAYS);
    }

    public function getUserPersonalizedGreeting(User $user): string
    {
        $hour = now()->format('H');
        $timeGreeting = match (true) {
            $hour < 12 => 'Buenos días',
            $hour < 18 => 'Buenas tardes',
            default => 'Buenas noches',
        };

        if ($user->isEmployer()) {
            return "{$timeGreeting}, {$user->name}. ¿Listo para encontrar el talento perfecto?";
        }

        return "{$timeGreeting}, {$user->name}. ¿Listo para encontrar tu próxima oportunidad?";
    }

    public function getUserInsights(User $user): array
    {
        if ($user->isEmployer()) {
            return $this->getEmployerInsights($user);
        }

        return $this->getCandidateInsights($user);
    }

    private function validateNotificationPreferences(array $preferences): array
    {
        $defaultPreferences = [
            'new_applications' => true,
            'status_changes' => true,
            'job_recommendations' => true,
            'marketing' => false,
        ];

        $validatedPreferences = [];
        foreach ($defaultPreferences as $key => $default) {
            $validatedPreferences[$key] = isset($preferences[$key])
                ? (bool) $preferences[$key]
                : $default;
        }

        return $validatedPreferences;
    }

    private function getCandidateInsights(User $user): array
    {
        $stats = $this->userRepository->getUserCandidateStatistics($user);
        $activity = $this->userRepository->getUserActivitySummary($user);

        $insights = [];

        if ($stats['applied_jobs'] === 0) {
            $insights[] = [
                'type' => 'suggestion',
                'message' => '¡Empieza tu búsqueda! Explora trabajos recomendados para ti.',
                'action' => 'Ver recomendaciones',
                'url' => route('jobs'),
            ];
        }

        if ($stats['saved_jobs'] > 5 && $stats['applied_jobs'] === 0) {
            $insights[] = [
                'type' => 'reminder',
                'message' => 'Tienes varios trabajos guardados. ¿Ya aplicaste a alguno?',
                'action' => 'Ver guardados',
                'url' => route('saved-jobs.index'),
            ];
        }

        if ($stats['interviews'] > 0) {
            $insights[] = [
                'type' => 'success',
                'message' => '¡Excelente! Tienes entrevistas programadas.',
                'action' => 'Ver aplicaciones',
                'url' => route('applications.index'),
            ];
        }

        return $insights;
    }

    private function getEmployerInsights(User $user): array
    {
        $employer = $user->employer;
        $insights = [];

        $activeJobs = $employer->jobs()->where('is_active', true)->count();
        if ($activeJobs === 0) {
            $insights[] = [
                'type' => 'suggestion',
                'message' => '¿Listo para encontrar talento? Publica tu primera oferta.',
                'action' => 'Crear trabajo',
                'url' => route('jobs.create'),
            ];
        }

        return $insights;
    }
}
