@extends('components.layout')

@section('content')
<div class="space-y-8">
    <!-- Header del Dashboard de Empresa -->
    <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-blue-500 rounded-2xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ auth()->user()->employer->name }}</h1>
                    <p class="text-slate-400">Panel de control empresarial</p>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <button class="bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-colors border border-slate-600/50">
                    Editar Perfil
                </button>
                <button class="bg-gradient-to-r from-emerald-600 to-blue-600 hover:from-emerald-700 hover:to-blue-700 text-white px-4 py-2 rounded-lg transition-all transform hover:scale-105" onclick="window.location.href='{{ route('jobs.create') }}'">
                    + Publicar Trabajo
                </button>
            </div>
        </div>
    </div>

    <!-- Estadísticas de Empresa -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-emerald-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Trabajos Activos</p>
                    <p class="text-2xl font-bold text-white">{{ $stats['active_jobs'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-blue-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Aplicaciones</p>
                    <p class="text-2xl font-bold text-white">{{ $stats['total_applications'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-purple-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Pendientes</p>
                    <p class="text-2xl font-bold text-white">{{ $stats['pending_applications'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Entrevistas</p>
                    <p class="text-2xl font-bold text-white">{{ $stats['interviews_scheduled'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Trabajos Publicados -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white">Trabajos Publicados</h2>
                    <div class="flex space-x-2">
                        <button class="text-slate-400 hover:text-white text-sm">Filtrar</button>
                        <button class="bg-gradient-to-r from-emerald-600 to-blue-600 hover:from-emerald-700 hover:to-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                            + Nuevo Trabajo
                        </button>
                    </div>
                </div>
                
                <div class="space-y-4">
                    @forelse($popular_jobs as $job)
                        <div class="p-4 bg-slate-700/30 rounded-xl border border-slate-600/30 hover:border-slate-600/50 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="font-semibold text-white">{{ $job->title }}</h3>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                            {{ $job->is_active ? 'Activo' : 'Pausado' }}
                                        </span>
                                        @if($job->featured)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                                Destacado
                                            </span>
                                        @endif
                                        @if($job->urgent)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30">
                                                Urgente
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-4 text-sm text-slate-400 mb-3">
                                        <span>{{ $job->location }} • {{ $job->type }}</span>
                                        <span>€{{ number_format($job->salary_min) }} - €{{ number_format($job->salary_max) }}</span>
                                        <span>{{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="flex items-center space-x-6 text-sm">
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <span class="text-slate-300">{{ $job->applications_count }} {{ Str::plural('aplicación', $job->applications_count) }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <span class="text-slate-300">{{ rand(50, 500) }} vistas</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('employer.applications', ['job_id' => $job->id]) }}" class="p-2 text-slate-400 hover:text-blue-400 hover:bg-blue-500/10 rounded-lg transition-colors" title="Ver aplicaciones">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </a>
                                    <button class="p-2 text-slate-400 hover:text-white hover:bg-slate-600/50 rounded-lg transition-colors" title="Editar trabajo">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-500">
                            <i class="fas fa-briefcase text-4xl mb-4"></i>
                            <p class="mb-4">No has publicado trabajos aún</p>
                            <a href="{{ route('jobs.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                Publicar Primer Trabajo
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Aplicaciones Recientes -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white">Aplicaciones Recientes</h2>
                    <a href="{{ route('employer.applications') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">Ver todas</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($recent_applications as $application)
                        <div class="p-4 bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-xl border border-blue-500/20">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center">
                                    <span class="text-white font-bold">{{ substr($application->user->name, 0, 1) }}</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="font-semibold text-white">{{ $application->user->name }}</h3>
                                            <p class="text-slate-400 text-sm">{{ $application->job->title }}</p>
                                            <p class="text-slate-500 text-xs">{{ $application->applied_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            @if($application->status === 'pending')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Pendiente
                                                </span>
                                            @elseif($application->status === 'interviewed')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    Entrevista
                                                </span>
                                            @elseif($application->status === 'accepted')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Aceptado
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Rechazado
                                                </span>
                                            @endif
                                            <a href="{{ route('employer.applications.show', $application) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs transition-colors">
                                                Ver detalles
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-500">
                            <i class="fas fa-inbox text-4xl mb-4"></i>
                            <p>No hay aplicaciones recientes</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Analíticas Rápidas -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Analíticas de la Semana</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Nuevas aplicaciones</span>
                        <div class="flex items-center space-x-2">
                            <span class="text-emerald-400 text-sm">+24</span>
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Vistas de trabajos</span>
                        <div class="flex items-center space-x-2">
                            <span class="text-blue-400 text-sm">+156</span>
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Tasa de respuesta</span>
                        <span class="text-purple-400 text-sm">85%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Tiempo promedio</span>
                        <span class="text-yellow-400 text-sm">2.3 días</span>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Acciones Rápidas</h3>
                <div class="space-y-3">
                    <button class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-xl border border-slate-600/30 transition-colors">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-slate-300 text-sm">Publicar nuevo trabajo</span>
                        </div>
                    </button>
                    <button class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-xl border border-slate-600/30 transition-colors">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-slate-300 text-sm">Buscar candidatos</span>
                        </div>
                    </button>
                    <button class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-xl border border-slate-600/30 transition-colors">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span class="text-slate-300 text-sm">Ver analíticas</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Actividad Reciente -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Actividad Reciente</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full mt-2"></div>
                        <div>
                            <p class="text-slate-300 text-sm">Nueva aplicación para Senior React Developer</p>
                            <p class="text-slate-500 text-xs">Hace 15 minutos</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-blue-400 rounded-full mt-2"></div>
                        <div>
                            <p class="text-slate-300 text-sm">Trabajo Backend Engineer fue visto 23 veces</p>
                            <p class="text-slate-500 text-xs">Hace 1 hora</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-purple-400 rounded-full mt-2"></div>
                        <div>
                            <p class="text-slate-300 text-sm">Entrevista programada con Ana Martínez</p>
                            <p class="text-slate-500 text-xs">Hace 2 horas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection