<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(
        private TagService $tagService
    ) {}

    public function show(Tag $tag)
    {
        $jobs = $tag->jobs()->with(['employer', 'tags'])
            ->latest()
            ->paginate(12);

        $relatedTags = $this->tagService->getRelatedTags($tag);

        return view('search-results', [
            'query' => $tag->name,
            'results' => $jobs,
            'tags' => $this->tagService->getAllTags(),
            'relatedTags' => $relatedTags,
            'currentTag' => $tag,
        ]);
    }

    public function autocomplete(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        $tags = $this->tagService->getTagsForAutocomplete($query);

        return response()->json([
            'tags' => $tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'jobs_count' => $tag->jobs_count,
                ];
            }),
        ]);
    }

    public function popular(): JsonResponse
    {
        $tags = $this->tagService->getPopularTags();

        return response()->json([
            'tags' => $tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'jobs_count' => $tag->jobs_count,
                ];
            }),
        ]);
    }

    public function cloud()
    {
        $tagCloud = $this->tagService->getTagCloud();

        return view('tags.cloud', compact('tagCloud'));
    }

    public function suggest(Request $request): JsonResponse
    {
        $title = $request->get('title', '');
        $description = $request->get('description', '');

        $suggestions = $this->tagService->suggestTagsForJob($title, $description);

        return response()->json([
            'suggestions' => $suggestions->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'jobs_count' => $tag->jobs_count,
                ];
            }),
        ]);
    }

    public function statistics(): JsonResponse
    {
        $stats = $this->tagService->getTagStatistics();

        return response()->json($stats);
    }
}
