<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        // Buscar trabajos asociados con la etiqueta recibida y mostrarlos
        
        return view('search-results', [
            'query' => $tag->name,
            'results' => $tag->jobs
        ]);
    }
}
