<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Employer;
use App\Repositories\EmployerRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployerService
{
    private const APPLICATIONS_PER_PAGE = 15;

    private const DASHBOARD_RECENT_LIMIT = 5;

    private const DASHBOARD_POPULAR_LIMIT = 5;

    public function __construct(
        private EmployerRepository $employerRepository
    ) {}

    public function getFilteredApplications(Employer $employer, Request $request): LengthAwarePaginator
    {
        $query = $this->employerRepository->getApplicationsQuery($employer);

        // Apply filters
        if ($request->filled('status')) {
            $query = $this->employerRepository->filterApplicationsByStatus($query, $request->status);
        }

        if ($request->filled('job_id')) {
            $query = $this->employerRepository->filterApplicationsByJob($query, $request->job_id);
        }

        if ($request->filled('date_from') || $request->filled('date_to')) {
            $query = $this->employerRepository->filterApplicationsByDateRange(
                $query,
                $request->date_from,
                $request->date_to
            );
        }

        if ($request->filled('candidate_search')) {
            $query = $this->employerRepository->filterApplicationsByCandidate($query, $request->candidate_search);
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'applied_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query = $this->employerRepository->sortApplications($query, $sortBy, $sortOrder);

        return $query->paginate(self::APPLICATIONS_PER_PAGE)->appends($request->query());
    }

    public function getApplicationsStatistics(Employer $employer): array
    {
        return $this->employerRepository->getApplicationsStatistics($employer);
    }

    public function getEmployerJobs(Employer $employer)
    {
        return $this->employerRepository->getEmployerJobs($employer);
    }

    public function canAccessApplication(Employer $employer, Application $application): bool
    {
        return $this->employerRepository->canAccessApplication($employer, $application);
    }

    public function updateApplicationStatus(Application $application, string $status, ?string $notes = null): bool
    {
        $this->validateStatusTransition($application->status, $status);

        return $this->employerRepository->updateApplicationStatus($application, $status, $notes);
    }

    public function getDashboardData(Employer $employer): array
    {
        return [
            'stats' => $this->employerRepository->getEmployerDashboardStats($employer),
            'recent_applications' => $this->employerRepository->getRecentApplications($employer, self::DASHBOARD_RECENT_LIMIT),
            'popular_jobs' => $this->employerRepository->getPopularJobs($employer, self::DASHBOARD_POPULAR_LIMIT),
        ];
    }

    public function getStatusMessage(string $status): string
    {
        return match ($status) {
            'pending' => 'La aplicación ha sido marcada como pendiente',
            'interviewed' => 'El candidato ha sido convocado para entrevista',
            'accepted' => 'La aplicación ha sido aceptada',
            'rejected' => 'La aplicación ha sido rechazada',
            default => 'Estado actualizado correctamente',
        };
    }

    private function validateStatusTransition(string $currentStatus, string $newStatus): void
    {
        $allowedStatuses = ['pending', 'interviewed', 'accepted', 'rejected'];

        if (! in_array($newStatus, $allowedStatuses)) {
            throw new \InvalidArgumentException("Estado no válido: {$newStatus}");
        }

        // Aquí podrías agregar lógica para validar transiciones de estado específicas
        // Por ejemplo, no permitir cambiar de 'accepted' a 'rejected'
    }
}
