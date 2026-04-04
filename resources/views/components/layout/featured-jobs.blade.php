<section>
    <div class="flex items-center mb-8">
        <div>
            <x-section-heading>🌟 Trabajos Destacados</x-section-heading>
            <p class="text-slate-400 mt-2">Los mejores trabajos seleccionados para ti</p>
        </div>
    </div>

    @if(count($featuredJobs) > 0)
        <!-- Contenedor de scroll horizontal -->
        <div class="relative ">
            <!-- Gradientes de fade en los bordes -->
            <div class="absolute left-0 top-0 bottom-0 w-8 bg-gradient-to-r from-slate-900 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-slate-900 to-transparent z-10 pointer-events-none"></div>
            
            <!-- Galería con scroll horizontal -->
            <div class="flex gap-6 overflow-x-auto scrollbar-none pb-4 snap-x snap-mandatory">
                @foreach ($featuredJobs as $job)
                    <div class="flex-none w-80 snap-start">
                        <x-job-card :job="$job" />
                    </div>
                @endforeach
            </div>
            
            <!-- Botones de navegación opcionales para desktop -->
            <button class="absolute left-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-slate-800/80 hover:bg-slate-700/80 text-slate-300 hover:text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-20 backdrop-blur-sm border border-slate-600/50" onclick="scrollFeatured('left')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-slate-800/80 hover:bg-slate-700/80 text-slate-300 hover:text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-20 backdrop-blur-sm border border-slate-600/50" onclick="scrollFeatured('right')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    @else
        <div class="text-center py-12 bg-slate-800/20 rounded-2xl border border-slate-700/30">
            No hay trabajos destacados disponibles en este momento.
        </div>
    @endif
</section>