<?php

namespace App\Services;

use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;

class TagService
{
    private const POPULAR_TAGS_LIMIT = 20;

    private const RELATED_TAGS_LIMIT = 5;

    private const AUTOCOMPLETE_LIMIT = 10;

    public function __construct(
        private TagRepository $tagRepository
    ) {}

    public function getAllTags(): Collection
    {
        return $this->tagRepository->getAllTags();
    }

    public function getPopularTags(?int $limit = null): Collection
    {
        return $this->tagRepository->getPopularTags($limit ?? self::POPULAR_TAGS_LIMIT);
    }

    public function getTagsWithJobCount(): Collection
    {
        return $this->tagRepository->getTagsWithJobCount();
    }

    public function searchTags(string $search, ?int $limit = null): Collection
    {
        if (strlen($search) < 2) {
            return collect();
        }

        return $this->tagRepository->searchTags($search, $limit ?? self::AUTOCOMPLETE_LIMIT);
    }

    public function createTagFromString(string $name): Tag
    {
        $normalizedName = $this->normalizeTagName($name);

        if (empty($normalizedName)) {
            throw new \InvalidArgumentException('El nombre del tag no puede estar vacío.');
        }

        return $this->tagRepository->findOrCreateTag($normalizedName);
    }

    public function createTagsFromString(string $tagsString): Collection
    {
        if (empty(trim($tagsString))) {
            return collect();
        }

        $tagNames = $this->parseTagsString($tagsString);

        return $this->tagRepository->bulkCreateTags($tagNames);
    }

    public function getRelatedTags(Tag $tag, ?int $limit = null): Collection
    {
        return $this->tagRepository->getRelatedTags($tag, $limit ?? self::RELATED_TAGS_LIMIT);
    }

    public function getTagStatistics(): array
    {
        return $this->tagRepository->getTagStatistics();
    }

    public function cleanupUnusedTags(): int
    {
        return $this->tagRepository->deleteUnusedTags();
    }

    public function getTagsForAutocomplete(string $query): Collection
    {
        if (strlen($query) < 2) {
            return $this->getPopularTags(self::AUTOCOMPLETE_LIMIT);
        }

        return $this->tagRepository->getTagsForAutocomplete($query, self::AUTOCOMPLETE_LIMIT);
    }

    public function mergeTags(Tag $sourceTag, Tag $targetTag): bool
    {
        if ($sourceTag->id === $targetTag->id) {
            throw new \InvalidArgumentException('No se puede fusionar un tag consigo mismo.');
        }

        return $this->tagRepository->mergeTags($sourceTag, $targetTag);
    }

    public function suggestTagsForJob(string $jobTitle, string $jobDescription = ''): Collection
    {
        $text = strtolower($jobTitle.' '.$jobDescription);
        $suggestions = collect();

        // Common tech tags mapping
        $techMappings = $this->getTechMappings();

        foreach ($techMappings as $keyword => $tagName) {
            if (str_contains($text, $keyword)) {
                $tag = $this->tagRepository->findTagByName($tagName);
                if ($tag) {
                    $suggestions->push($tag);
                }
            }
        }

        // Also search for existing popular tags that might match
        $words = str_word_count($text, 1);
        foreach ($words as $word) {
            if (strlen($word) > 3) {
                $matchingTags = $this->tagRepository->searchTags($word, 3);
                $suggestions = $suggestions->merge($matchingTags);
            }
        }

        return $suggestions->unique('id')->take(8);
    }

    public function getTagCloud(): Collection
    {
        return $this->tagRepository->getPopularTags(50)
            ->map(function ($tag) {
                $tag->weight = $this->calculateTagWeight($tag->jobs_count);

                return $tag;
            });
    }

    private function normalizeTagName(string $name): string
    {
        return trim(strtolower(preg_replace('/[^a-zA-Z0-9\s\-_]/', '', $name)));
    }

    private function parseTagsString(string $tagsString): array
    {
        // Split by comma, semicolon, or pipe
        $tags = preg_split('/[,;|]/', $tagsString);

        return array_filter(array_map(function ($tag) {
            return $this->normalizeTagName($tag);
        }, $tags));
    }

    private function getTechMappings(): array
    {
        return [
            'javascript' => 'javascript',
            'js' => 'javascript',
            'react' => 'react',
            'vue' => 'vue',
            'angular' => 'angular',
            'node' => 'nodejs',
            'php' => 'php',
            'laravel' => 'laravel',
            'python' => 'python',
            'django' => 'django',
            'java' => 'java',
            'spring' => 'spring',
            'c#' => 'csharp',
            '.net' => 'dotnet',
            'sql' => 'sql',
            'mysql' => 'mysql',
            'postgresql' => 'postgresql',
            'mongodb' => 'mongodb',
            'aws' => 'aws',
            'docker' => 'docker',
            'kubernetes' => 'kubernetes',
            'git' => 'git',
            'frontend' => 'frontend',
            'backend' => 'backend',
            'fullstack' => 'fullstack',
            'mobile' => 'mobile',
            'ios' => 'ios',
            'android' => 'android',
            'ui/ux' => 'design',
            'design' => 'design',
        ];
    }

    private function calculateTagWeight(int $jobsCount): string
    {
        return match (true) {
            $jobsCount >= 50 => 'xl',
            $jobsCount >= 20 => 'lg',
            $jobsCount >= 10 => 'md',
            $jobsCount >= 5 => 'sm',
            default => 'xs',
        };
    }
}
