<x-layout>
    <div class="space-y-8">
        <!-- Header con resultados -->
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                @if($query)
                    Resultados para: <span class="text-blue-400">"{{ $query }}"</span>
                @else
                    Resultados de búsqueda
                @endif
            </h1>
            <p class="text-slate-400">
                {{ $results->total() }} {{ $results->total() === 1 ? 'trabajo encontrado' : 'trabajos encontrados' }}
            </p>
        </div>

        <!-- Filtros de búsqueda avanzada -->
        <x-advanced-search :tags="$tags" />

        <!-- Filtros aplicados -->
        @if(array_filter($filters))
            <div class="bg-slate-800/30 rounded-xl p-4 border border-slate-700/50">
                <h3 class="text-sm font-medium text-slate-300 mb-3">Filtros aplicados:</h3>
                <div class="flex flex-wrap gap-2">
                    @if(!empty($filters['location']))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-600/20 text-blue-400 border border-blue-500/30">
                            📍 {{ ucfirst($filters['location']) }}
                            <a href="{{ request()->fullUrlWithQuery(['location' => null]) }}" class="ml-2 hover:text-blue-300">×</a>
                        </span>
                    @endif
                    @if(!empty($filters['schedule']))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-600/20 text-green-400 border border-green-500/30">
                            ⏰ {{ ucfirst(str_replace('-', ' ', $filters['schedule'])) }}
                            <a href="{{ request()->fullUrlWithQuery(['schedule' => null]) }}" class="ml-2 hover:text-green-300">×</a>
                        </span>
                    @endif
                    @if(!empty($filters['salary_range']))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-600/20 text-yellow-400 border border-yellow-500/30">
                            💰 €{{ $filters['salary_range'] === '100000+' ? '100k+' : str_replace('-', 'k - €', $filters['salary_range']) . 'k' }}
                            <a href="{{ request()->fullUrlWithQuery(['salary_range' => null]) }}" class="ml-2 hover:text-yellow-300">×</a>
                        </span>
                    @endif
                    @if(!empty($filters['experience']))
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-600/20 text-purple-400 border border-purple-500/30">
                            🎯 {{ ucfirst($filters['experience']) }}
                            <a href="{{ request()->fullUrlWithQuery(['experience' => null]) }}" class="ml-2 hover:text-purple-300">×</a>
                        </span>
                    @endif
                    @if(!empty($filters['tags']))
                        @foreach($filters['tags'] as $tagId)
                            @php
                                $tag = $tags->find($tagId);
                            @endphp
                            @if($tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-600/20 text-slate-300 border border-slate-500/30">
                                    🏷️ {{ $tag->name }}
                                    <a href="{{ request()->fullUrlWithQuery(['tags' => array_diff($filters['tags'], [$tagId])]) }}" class="ml-2 hover:text-slate-200">×</a>
                                </span>
                            @endif
                        @endforeach
                    @endif
                    
                    <!-- Limpiar todos los filtros -->
                    <a href="/search" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-600/20 text-red-400 border border-red-500/30 hover:bg-red-600/30 transition-colors">
                        🗑️ Limpiar todo
                    </a>
                </div>
            </div>
        @endif

        <!-- Resultados -->
        <div class="space-y-4">
            @forelse ($results as $job)
                <x-job-card-wide :job="$job" />
            @empty
                <div class="text-center py-12 bg-slate-800/20 rounded-2xl border border-slate-700/30">
                    <div class="w-24 h-24 mx-auto mb-4 bg-slate-800/50 rounded-2xl flex items-center justify-center">
                        <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-300 mb-2">No se encontraron trabajos</h3>
                    <p class="text-slate-500 mb-4">Intenta ajustar tus filtros o términos de búsqueda</p>
                    <div class="space-y-2">
                        <p class="text-sm text-slate-400">Sugerencias:</p>
                        <ul class="text-sm text-slate-500 space-y-1">
                            <li>• Verifica la ortografía de las palabras clave</li>
                            <li>• Usa términos más generales</li>
                            <li>• Reduce el número de filtros aplicados</li>
                        </ul>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if($results->hasPages())
            <div class="mt-8 flex justify-center">
                <nav class="flex items-center space-x-2">
                    {{-- Botón anterior --}}
                    @if ($results->onFirstPage())
                        <span class="px-3 py-2 text-slate-500 bg-slate-800/50 rounded-lg cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $results->previousPageUrl() }}" class="px-3 py-2 text-slate-300 bg-slate-800/50 hover:bg-slate-700/50 hover:text-white rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    @endif

                    {{-- Números de página --}}
                    @foreach ($results->getUrlRange(1, $results->lastPage()) as $page => $url)
                        @if ($page == $results->currentPage())
                            <span class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-medium">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-slate-300 bg-slate-800/50 hover:bg-slate-700/50 hover:text-white rounded-lg transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Botón siguiente --}}
                    @if ($results->hasMorePages())
                        <a href="{{ $results->nextPageUrl() }}" class="px-3 py-2 text-slate-300 bg-slate-800/50 hover:bg-slate-700/50 hover:text-white rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <span class="px-3 py-2 text-slate-500 bg-slate-800/50 rounded-lg cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endif
                </nav>
            </div>

            {{-- Información de paginación --}}
            <div class="mt-4 text-center text-sm text-slate-400">
                Mostrando {{ $results->firstItem() }} - {{ $results->lastItem() }} de {{ $results->total() }} trabajos
            </div>
        @endif
    </div>
</x-layout>