 <section id="trabajos-recientes">
    <div class="flex items-center mb-8">
        <div>
            <x-section-heading>🕐 Trabajos Recientes</x-section-heading>
            <p class="text-slate-400 mt-2">Las últimas oportunidades publicadas</p>
        </div>
    </div>

    <div class="space-y-4">
        @forelse ($jobs as $job)
            <x-job-card-wide :job="$job" />
        @empty
            <div class="text-center py-12 bg-slate-800/20 rounded-2xl border border-slate-700/30">
                <div class="w-24 h-24 mx-auto mb-4 bg-slate-800/50 rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-300 mb-2">No hay trabajos recientes</h3>
                <p class="text-slate-500">Sé el primero en publicar una oportunidad</p>
                <a href="/jobs/create" class="inline-block mt-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 transform hover:scale-105">
                    Publicar Trabajo
                </a>
            </div>
        @endforelse
    </div>

    <!-- Paginación personalizada -->
    @if($jobs->hasPages())
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-2">
                {{-- Botón anterior --}}
                @if ($jobs->onFirstPage())
                    <span class="px-3 py-2 text-slate-500 bg-slate-800/50 rounded-lg cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </span>
                @else
                    <a href="{{ $jobs->previousPageUrl() }}" class="px-3 py-2 text-slate-300 bg-slate-800/50 hover:bg-slate-700/50 hover:text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                @endif

                {{-- Números de página --}}
                @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                    @if ($page == $jobs->currentPage())
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
                @if ($jobs->hasMorePages())
                    <a href="{{ $jobs->nextPageUrl() }}" class="px-3 py-2 text-slate-300 bg-slate-800/50 hover:bg-slate-700/50 hover:text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @else
                    <span class="px-3 py-2 text-slate-500 bg-slate-800/50 rounded-lg cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </span>
                @endif
            </nav>
        </div>

        {{-- Información de paginación --}}
        <div class="mt-4 text-center text-sm text-slate-400">
            Mostrando {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} de {{ $jobs->total() }} trabajos
        </div>
    @endif
</section>