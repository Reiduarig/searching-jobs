<?php

namespace App\Services;

use App\Models\Job;
use App\Models\User;
use App\Repositories\JobRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class JobService
{
    private const FEATURED_JOBS_LIMIT = 10;

    private const RECENT_JOBS_PER_PAGE = 6;

    private const RELATED_JOBS_LIMIT = 3;

    public function __construct(
        private JobRepository $jobRepository,
        private TagService $tagService
    ) {}

    public function getFeaturedJobs(): Collection
    {
        return $this->jobRepository->getFeaturedJobs();
    }

    public function getRecentJobs(): LengthAwarePaginator
    {
        return $this->jobRepository->getRecentJobs(self::RECENT_JOBS_PER_PAGE);
    }

    public function getAllTags(): Collection
    {
        return $this->tagService->getAllTags();
    }

    public function getJobWithRelations(Job $job): Job
    {
        return $this->jobRepository->getJobWithRelations($job);
    }

    public function getRelatedJobs(Job $job): Collection
    {
        return $this->jobRepository->getRelatedJobs($job, self::RELATED_JOBS_LIMIT);
    }

    public function checkUserApplicationStatus(Job $job, ?User $user): bool
    {
        return $this->jobRepository->checkUserApplicationStatus($job, $user);
    }

    public function checkUserSavedStatus(Job $job, ?User $user): bool
    {
        return $this->jobRepository->checkUserSavedStatus($job, $user);
    }

    public function attachTagsToJob(Job $job, ?string $tagsString): void
    {
        if (! $tagsString) {
            return;
        }

        $tags = $this->tagService->createTagsFromString($tagsString);

        foreach ($tags as $tag) {
            if (! $job->tags()->where('tag_id', $tag->id)->exists()) {
                $job->tags()->attach($tag->id);
            }
        }
    }

    public function suggestTagsForJob(Job $job): Collection
    {
        return $this->tagService->suggestTagsForJob($job->title, $job->description ?? '');
    }
}
