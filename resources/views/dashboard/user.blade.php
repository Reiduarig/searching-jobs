<x-layout>
<div class="space-y-8">
    <!-- Header del Dashboard -->
    <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center">
                    <span class="text-2xl font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">¡Hola, {{ auth()->user()->name }}!</h1>
                    <p class="text-slate-400">Bienvenido a tu dashboard profesional</p>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <button class="bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-colors border border-slate-600/50">
                    Editar Perfil
                </button>
                <div class="relative group">
                    <button class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-4 py-2 rounded-lg transition-all transform hover:scale-105 flex items-center space-x-2">
                        <span>Configuración</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-64 bg-slate-800 rounded-lg shadow-xl border border-slate-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <a href="{{ route('notifications.preferences') }}" class="block px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-700/50 transition-colors border-b border-slate-700/50">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-bell text-blue-400"></i>
                                    <div>
                                        <div class="font-medium">Notificaciones</div>
                                        <div class="text-xs text-slate-400">Gestionar preferencias de email</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-700/50 transition-colors border-b border-slate-700/50">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-shield-alt text-green-400"></i>
                                    <div>
                                        <div class="font-medium">Privacidad</div>
                                        <div class="text-xs text-slate-400">Configurar seguridad</div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-700/50 transition-colors">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-cog text-purple-400"></i>
                                    <div>
                                        <div class="font-medium">General</div>
                                        <div class="text-xs text-slate-400">Configuración general</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50 hover:border-blue-500/30 transition-all duration-200 group cursor-pointer" onclick="window.location.href='{{ route('applications.index') }}'">
            <div class="flex items-center">
                <div class="p-2 bg-blue-500/20 rounded-xl group-hover:bg-blue-500/30 transition-colors">
                    <svg class="w-6 h-6 text-blue-400 group-hover:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm group-hover:text-slate-300">Trabajos Aplicados</p>
                    <p class="text-2xl font-bold text-white group-hover:text-blue-300">{{ $stats['applied_jobs'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-green-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Entrevistas</p>
                    <p class="text-2xl font-bold text-white">{{ $stats['interviews'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50 hover:border-purple-500/30 transition-all duration-200 group cursor-pointer" onclick="window.location.href='{{ route('saved-jobs.index') }}'">
            <div class="flex items-center">
                <div class="p-2 bg-purple-500/20 rounded-xl group-hover:bg-purple-500/30 transition-colors">
                    <svg class="w-6 h-6 text-purple-400 group-hover:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm group-hover:text-slate-300">Guardados</p>
                    <p class="text-2xl font-bold text-white group-hover:text-purple-300">{{ $stats['saved_jobs'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Perfil Views</p>
                    <p class="text-2xl font-bold text-white">{{ $stats['profile_views'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Aplicaciones Recientes -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white">Aplicaciones Recientes</h2>
                    <a href="{{ route('applications.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">Ver todas</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($recent_applications as $application)
                        <div class="flex items-center justify-between p-4 bg-slate-700/30 rounded-xl border border-slate-600/30">
                            <div class="flex items-center space-x-4">
                                <x-employer-logo :employer="$application->job->employer" :width="48" />
                                <div>
                                    <h3 class="font-semibold text-white">{{ $application->job->title }}</h3>
                                    <p class="text-slate-400 text-sm">{{ $application->job->employer->name }} • {{ $application->job->location ?? 'Remoto' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $application->status_color }}-500/20 text-{{ $application->status_color }}-400 border border-{{ $application->status_color }}-500/30">
                                    {{ $application->status_label }}
                                </span>
                                <p class="text-slate-500 text-xs mt-1">{{ $application->applied_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-slate-400 mb-4">No has aplicado a ningún trabajo aún</p>
                            <a href="{{ route('jobs') }}" class="text-blue-400 hover:text-blue-300 font-medium">
                                Explorar trabajos disponibles
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Trabajos Guardados Recientes -->
            @if($saved_jobs->count() > 0)
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white">Trabajos Guardados</h2>
                    <a href="{{ route('saved-jobs.index') }}" class="text-purple-400 hover:text-purple-300 text-sm font-medium">Ver todos</a>
                </div>
                
                <div class="space-y-4">
                    @foreach($saved_jobs as $savedJob)
                        <div class="flex items-center justify-between p-4 bg-slate-700/30 rounded-xl border border-slate-600/30">
                            <div class="flex items-center space-x-4">
                                <x-employer-logo :employer="$savedJob->job->employer" :width="48" />
                                <div>
                                    <h3 class="font-semibold text-white">{{ $savedJob->job->title }}</h3>
                                    <p class="text-slate-400 text-sm">{{ $savedJob->job->employer->name }} • {{ $savedJob->job->location ?? 'Remoto' }}</p>
                                    @if($savedJob->job->salary_min && $savedJob->job->salary_max)
                                        <p class="text-green-400 text-sm">€{{ number_format($savedJob->job->salary_min) }} - €{{ number_format($savedJob->job->salary_max) }}/{{ $savedJob->job->salary_period === 'year' ? 'año' : $savedJob->job->salary_period }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right flex items-center space-x-3">
                                <div>
                                    <p class="text-slate-500 text-xs">Guardado {{ $savedJob->saved_at->diffForHumans() }}</p>
                                    @if($savedJob->job->tags->count() > 0)
                                        <div class="flex space-x-1 mt-1">
                                            @foreach($savedJob->job->tags->take(2) as $tag)
                                                <span class="px-2 py-1 bg-slate-700/50 text-slate-300 text-xs rounded-full">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <x-apply-button :job="$savedJob->job" />
                                    <x-save-button :job="$savedJob->job" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recomendaciones -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-white">Recomendado para ti</h2>
                        <p class="text-slate-400 text-sm mt-1">Basado en tus aplicaciones anteriores y trabajos guardados</p>
                    </div>
                    <a href="{{ route('jobs') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">Ver más trabajos</a>
                </div>
                
                <div class="grid gap-4">
                    @forelse($recommended_jobs as $job)
                        <div class="p-4 bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-xl border border-blue-500/20">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-semibold text-white">{{ $job->title }}</h3>
                                    <p class="text-slate-400 text-sm">
                                        {{ $job->employer->name }} • {{ $job->location }} 
                                        @if($job->salary_min && $job->salary_max)
                                            • €{{ number_format($job->salary_min) }}-{{ number_format($job->salary_max) }}/{{ $job->salary_period }}
                                        @endif
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs bg-blue-500/20 text-blue-400 px-2 py-1 rounded-full">Recomendado</span>
                                    @if($job->created_at->gt(now()->subDays(7)))
                                        <span class="text-xs bg-green-500/20 text-green-400 px-2 py-1 rounded-full ml-1">Nuevo</span>
                                    @endif
                                </div>
                            </div>
                            @if($job->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach($job->tags->take(3) as $tag)
                                        <span class="px-2 py-1 bg-slate-700/50 text-slate-300 text-xs rounded-full">{{ $tag->name }}</span>
                                    @endforeach
                                    @if($job->tags->count() > 3)
                                        <span class="px-2 py-1 bg-slate-700/50 text-slate-400 text-xs rounded-full">+{{ $job->tags->count() - 3 }}</span>
                                    @endif
                                </div>
                            @endif
                            <a href="{{ $job->url }}" target="_blank" class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-2 px-4 rounded-lg text-sm font-medium transition-all text-center">
                                Ver trabajo
                            </a>
                        </div>
                    @empty
                        <div class="p-6 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                            <p class="text-slate-400 mb-4">No hay trabajos disponibles en este momento</p>
                            <a href="{{ route('jobs') }}" class="text-blue-400 hover:text-blue-300 font-medium">
                                Explorar todos los trabajos
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Completar Perfil -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Completa tu perfil</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Información básica</span>
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Experiencia laboral</span>
                        <button class="text-blue-400 hover:text-blue-300 text-xs">Añadir</button>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Habilidades</span>
                        <button class="text-blue-400 hover:text-blue-300 text-xs">Añadir</button>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Portfolio/CV</span>
                        <button class="text-blue-400 hover:text-blue-300 text-xs">Subir</button>
                    </div>
                </div>
                <div class="mt-4 bg-slate-700/30 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" style="width: 25%"></div>
                </div>
                <p class="text-slate-400 text-xs mt-2">25% completado</p>
            </div>

            <!-- Actividad Reciente -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Actividad Reciente</h3>
                <div class="space-y-3">
                    @if($recent_applications->count() > 0)
                        @foreach($recent_applications->take(2) as $application)
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-slate-300 text-sm">Aplicaste a {{ $application->job->title }} en {{ $application->job->employer->name }}</p>
                                    <p class="text-slate-500 text-xs">{{ $application->applied_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                    @if($saved_jobs->count() > 0)
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-purple-400 rounded-full mt-2"></div>
                            <div>
                                <p class="text-slate-300 text-sm">Guardaste {{ $saved_jobs->count() }} trabajo{{ $saved_jobs->count() !== 1 ? 's' : '' }} nuevo{{ $saved_jobs->count() !== 1 ? 's' : '' }}</p>
                                <p class="text-slate-500 text-xs">{{ $saved_jobs->first()->saved_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($recent_applications->count() == 0 && $saved_jobs->count() == 0)
                        <div class="text-center py-4">
                            <p class="text-slate-400 text-sm">No hay actividad reciente</p>
                            <p class="text-slate-500 text-xs mt-1">¡Empieza a aplicar a trabajos!</p>
                        </div>
                    @endif
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-green-400 rounded-full mt-2"></div>
                        <div>
                            <p class="text-slate-300 text-sm">Creaste tu perfil en JobSearch</p>
                            <p class="text-slate-500 text-xs">{{ auth()->user()->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Acciones Rápidas</h3>
                <div class="space-y-3">
                    <a href="{{ route('applications.index') }}" class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-xl border border-slate-600/30 transition-colors block">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-slate-300 text-sm">Mis aplicaciones</span>
                        </div>
                    </a>
                    <a href="{{ route('saved-jobs.index') }}" class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-xl border border-slate-600/30 transition-colors block">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="text-slate-300 text-sm">Trabajos guardados</span>
                        </div>
                    </a>
                    <a href="{{ route('jobs') }}" class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-xl border border-slate-600/30 transition-colors block">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span class="text-slate-300 text-sm">Buscar trabajos</span>
                        </div>
                    </a>
                    <button class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-xl border border-slate-600/30 transition-colors" onclick="notificationManager.info('Funcionalidad de CV próximamente disponible')">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-slate-300 text-sm">Actualizar CV</span>
                        </div>
                    </button>
                    <button class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-xl border border-slate-600/30 transition-colors" onclick="notificationManager.info('Perfil público próximamente disponible')">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-slate-300 text-sm">Ver perfil público</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>