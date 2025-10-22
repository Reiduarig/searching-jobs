<x-layout>
    <div class="space-y-16">
        <!-- Hero Section con diseño moderno -->
        <section class="text-center py-12 relative">
            <!-- Efectos visuales de fondo -->
            <div class="absolute inset-0 flex items-center justify-center opacity-10">
                <div class="w-96 h-96 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative z-10 space-y-8">
                <div class="space-y-4">
                    <h1 class="font-bold text-5xl md:text-6xl lg:text-7xl bg-gradient-to-r from-white via-blue-100 to-purple-100 bg-clip-text text-transparent leading-tight">
                        Encuentra el trabajo de
                        <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">tus sueños</span>
                    </h1>
                    <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                        Conectamos el mejor talento con las mejores oportunidades. Tu próximo empleo te está esperando.
                    </p>
                </div>
                
                <!-- Barra de búsqueda mejorada -->
                <div class="max-w-2xl mx-auto">
                    <x-forms.form action="/search" class="relative">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <x-forms.input 
                                name="q" 
                                placeholder="Ej: Desarrollador Full Stack, Diseñador UX/UI, Project Manager..." 
                                :label="false"
                                class="w-full pl-12 pr-32 py-4 bg-slate-800/60 backdrop-blur-sm border border-slate-700/50 placeholder-slate-400 rounded-2xl text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-slate-800/80 transition-all duration-300"
                            />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg">
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </x-forms.form>
                </div>

                <!-- Estadísticas -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto mt-12">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-400">1000+</div>
                        <div class="text-slate-400 text-sm">Trabajos Activos</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-400">500+</div>
                        <div class="text-slate-400 text-sm">Empresas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-400">2000+</div>
                        <div class="text-slate-400 text-sm">Profesionales</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">95%</div>
                        <div class="text-slate-400 text-sm">Tasa de Éxito</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Trabajos Destacados -->
        <section>
            <div class="flex items-center justify-between mb-8">
                <div>
                    <x-section-heading>🌟 Trabajos Destacados</x-section-heading>
                    <p class="text-slate-400 mt-2">Los mejores trabajos seleccionados para ti</p>
                </div>
                <a href="#" class="text-blue-400 hover:text-blue-300 font-medium flex items-center space-x-1 transition-colors">
                    <span>Ver todos</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            <div class="grid lg:grid-cols-3 gap-6">
                @forelse ($featuredJobs as $job)
                    <x-job-card :job="$job" />
                @empty
                    <div class="col-span-3 text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-4 bg-slate-800/50 rounded-2xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-300 mb-2">No hay trabajos destacados</h3>
                        <p class="text-slate-500">Vuelve pronto para ver nuevas oportunidades</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Categorías/Tags -->
        <section>
            <div class="mb-8">
                <x-section-heading>🏷️ Explora por Categorías</x-section-heading>
                <p class="text-slate-400 mt-2">Encuentra trabajos por área de especialización</p>
            </div>
            
            <div class="flex flex-wrap gap-3">
                @forelse ($tags as $tag)
                    <x-tag :tag="$tag" />
                @empty
                    <div class="text-center py-8 w-full">
                        <span class="text-slate-500">No hay categorías disponibles</span>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Trabajos Recientes -->
        <section>
            <div class="flex items-center justify-between mb-8">
                <div>
                    <x-section-heading>🕐 Trabajos Recientes</x-section-heading>
                    <p class="text-slate-400 mt-2">Las últimas oportunidades publicadas</p>
                </div>
                <a href="#" class="text-blue-400 hover:text-blue-300 font-medium flex items-center space-x-1 transition-colors">
                    <span>Ver todos</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
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
        </section>
    </div>
</x-layout>
