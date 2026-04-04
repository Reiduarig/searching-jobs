<?php

namespace App\Http\Controllers;

use App\Services\JobSearchService;
use App\Services\TagService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        private JobSearchService $jobSearchService,
        private TagService $tagService
    ) {}

    public function __invoke(Request $request)
    {
        $results = $this->jobSearchService->search($request);
        $tags = $this->tagService->getAllTags();

        return view('search-results', [
            'query' => $request->input('search'),
            'results' => $results,
            'tags' => $tags,
            'filters' => $request->all(),
        ]);
    }
}
