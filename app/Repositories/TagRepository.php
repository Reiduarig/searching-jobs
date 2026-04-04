<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class TagRepository
{
    public function getAllTags(): Collection
    {
        return Tag::all();
    }

    public function getPopularTags(int $limit = 20): Collection
    {
        return Tag::withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->take($limit)
            ->get();
    }

    public function getTagsWithJobCount(): Collection
    {
        return Tag::withCount('jobs')
            ->orderBy('name')
            ->get();
    }

    public function searchTags(string $search, int $limit = 10): Collection
    {
        return Tag::where('name', 'like', "%{$search}%")
            ->withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->take($limit)
            ->get();
    }

    public function findOrCreateTag(string $name): Tag
    {
        return Tag::firstOrCreate([
            'name' => trim(strtolower($name)),
        ]);
    }

    public function findTagByName(string $name): ?Tag
    {
        return Tag::where('name', trim(strtolower($name)))->first();
    }

    public function getUnusedTags(): Collection
    {
        return Tag::doesntHave('jobs')->get();
    }

    public function getTagsByIds(array $ids): Collection
    {
        return Tag::whereIn('id', $ids)->get();
    }

    public function getRelatedTags(Tag $tag, int $limit = 5): Collection
    {
        // Tags that appear together with this tag in jobs
        return Tag::whereHas('jobs', function (Builder $query) use ($tag) {
            $query->whereHas('tags', function (Builder $q) use ($tag) {
                $q->where('tags.id', $tag->id);
            });
        })
            ->where('id', '!=', $tag->id)
            ->withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->take($limit)
            ->get();
    }

    public function getTagStatistics(): array
    {
        $totalTags = Tag::count();
        $usedTags = Tag::has('jobs')->count();
        $unusedTags = $totalTags - $usedTags;

        $mostUsedTag = Tag::withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->first();

        return [
            'total_tags' => $totalTags,
            'used_tags' => $usedTags,
            'unused_tags' => $unusedTags,
            'most_used_tag' => $mostUsedTag?->name,
            'most_used_count' => $mostUsedTag?->jobs_count ?? 0,
        ];
    }

    public function deleteUnusedTags(): int
    {
        return Tag::doesntHave('jobs')->delete();
    }

    public function bulkCreateTags(array $tagNames): SupportCollection
    {
        $tags = collect();

        foreach ($tagNames as $name) {
            $tags->push($this->findOrCreateTag($name));
        }

        return $tags;
    }

    public function getTagsForAutocomplete(string $query, int $limit = 10): Collection
    {
        return Tag::where('name', 'like', "%{$query}%")
            ->has('jobs') // Only tags that are actually used
            ->withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->take($limit)
            ->get(['id', 'name', 'jobs_count']);
    }

    public function mergeTags(Tag $sourceTag, Tag $targetTag): bool
    {
        // Move all jobs from source tag to target tag
        $sourceTag->jobs()->each(function ($job) use ($targetTag) {
            if (! $job->tags()->where('tag_id', $targetTag->id)->exists()) {
                $job->tags()->attach($targetTag->id);
            }
        });

        // Detach source tag from all jobs
        $sourceTag->jobs()->detach();

        // Delete source tag
        return $sourceTag->delete();
    }
}
