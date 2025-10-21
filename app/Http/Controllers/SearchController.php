<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('q');

        $results = Job::where('title', 'like', '%' . $query . '%')
            ->with(['employer', 'tags'])
            ->get();

        // Retorna una vista con los resultados de la búsqueda
        return view('search-results', [
            'query' => $query,
            'results' => $results
        ]);
    }
}
