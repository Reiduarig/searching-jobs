<?php

namespace App\Services;

use App\Repositories\JobRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class JobSearchService
{
    private const RESULTS_PER_PAGE = 12;

    public function __construct(
        private JobRepository $jobRepository
    ) {}

    public function search(Request $request): LengthAwarePaginator
    {
        $filters = $this->buildFiltersFromRequest($request);

        return $this->jobRepository->searchJobs($filters)
            ->latest()
            ->paginate(self::RESULTS_PER_PAGE)
            ->appends($request->query());
    }

    private function buildFiltersFromRequest(Request $request): array
    {
        $filters = [];

        if ($request->filled('search')) {
            $filters['search'] = $request->input('search');
        }

        if ($request->filled('location')) {
            $filters['location'] = $request->input('location');
        }

        if ($request->filled('schedule')) {
            $filters['schedule'] = $request->input('schedule');
        }

        if ($request->filled('salary_range')) {
            $filters['salary_range'] = $request->input('salary_range');
        }

        if ($request->filled('experience')) {
            $filters['experience'] = $request->input('experience');
        }

        if ($request->filled('tags')) {
            $filters['tags'] = $request->input('tags');
        }

        return $filters;
    }
}
