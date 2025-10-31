@extends('components.layout')

@section('content')
<div class="space-y-8">
    <!-- Hero Section de la Empresa -->
    <div class="relative bg-slate-800/40 backdrop-blur-sm rounded-2xl overflow-hidden border border-slate-700/50">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.02"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        
        <div class="relative p-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <!-- Info Principal -->
                <div class="flex items-start space-x-6">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <span class="text-3xl font-bold text-white">{{ substr($employer->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $employer->name }}</h1>
                        <p class="text-slate-300 text-lg mb-4">{{ $employer->description ?? 'Empresa líder en tecnología' }}</p>
                        
                        <div class="flex flex-wrap items-center gap-4 text-sm text-slate-400">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Madrid, España</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>500-1000 empleados</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                </svg>
                                <span>{{ $employer->jobs->count() }} trabajos activos</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <div class="mt-6 lg:mt-0 flex flex-col sm:flex-row gap-3">
                    <button class="bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-6 py-3 rounded-xl transition-colors border border-slate-600/50 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span>Seguir</span>
                    </button>
                    <button class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-3 rounded-xl transition-all transform hover:scale-105 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Ver trabajos</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas de la Empresa -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50 text-center">
            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                </svg>
            </div>
            <p class="text-2xl font-bold text-white mb-1">{{ $employer->jobs->count() }}</p>
            <p class="text-slate-400 text-sm">Trabajos Activos</p>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50 text-center">
            <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-2xl font-bold text-white mb-1">4.8</p>
            <p class="text-slate-400 text-sm">Rating Promedio</p>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50 text-center">
            <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <p class="text-2xl font-bold text-white mb-1">850+</p>
            <p class="text-slate-400 text-sm">Empleados</p>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50 text-center">
            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <p class="text-2xl font-bold text-white mb-1">2018</p>
            <p class="text-slate-400 text-sm">Fundada</p>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Sobre la Empresa -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h2 class="text-xl font-bold text-white mb-4">Sobre {{ $employer->name }}</h2>
                <div class="prose prose-slate prose-invert">
                    <p class="text-slate-300 leading-relaxed">
                        {{ $employer->name }} es una empresa líder en el sector tecnológico, comprometida con la innovación y el desarrollo de soluciones que transforman la forma en que las personas trabajan y viven. Con más de 5 años de experiencia en el mercado, nos especializamos en crear productos digitales de alta calidad que impactan positivamente en la vida de millones de usuarios.
                    </p>
                    <p class="text-slate-300 leading-relaxed mt-4">
                        Nuestro equipo está compuesto por profesionales talentosos y apasionados que comparten nuestra visión de crear un futuro mejor a través de la tecnología. Creemos en la diversidad, la inclusión y el crecimiento profesional continuo de nuestros empleados.
                    </p>
                </div>
            </div>

            <!-- Trabajos Disponibles -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white">Trabajos Disponibles ({{ $employer->jobs->count() }})</h2>
                    <a href="{{ route('jobs.index', ['employer' => $employer->id]) }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">Ver todos</a>
                </div>
                
                @if($employer->jobs->count() > 0)
                    <div class="space-y-4">
                        @foreach($employer->jobs->take(3) as $job)
                        <div class="p-4 bg-slate-700/30 rounded-xl border border-slate-600/30 hover:border-slate-600/50 transition-all">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-white mb-2">{{ $job->title }}</h3>
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-400 mb-3">
                                        <span>{{ $job->location ?? 'Madrid' }}</span>
                                        <span>{{ ucfirst($job->schedule ?? 'Tiempo completo') }}</span>
                                        @if($job->salary_min && $job->salary_max)
                                            <span class="text-emerald-400 font-medium">
                                                €{{ number_format($job->salary_min) }} - €{{ number_format($job->salary_max) }}
                                                @if($job->salary_period !== 'month') / {{ $job->salary_period === 'year' ? 'año' : $job->salary_period }} @endif
                                            </span>
                                        @elseif($job->salary_min)
                                            <span class="text-emerald-400 font-medium">
                                                Desde €{{ number_format($job->salary_min) }}
                                                @if($job->salary_period !== 'month') / {{ $job->salary_period === 'year' ? 'año' : $job->salary_period }} @endif
                                            </span>
                                        @endif
                                        @if($job->urgent)
                                            <span class="text-red-400 font-medium text-xs bg-red-500/20 px-2 py-1 rounded-full">URGENTE</span>
                                        @endif
                                    </div>
                                    @if($job->description)
                                        <p class="text-slate-300 text-sm line-clamp-2 mb-3">{{ $job->description }}</p>
                                    @endif
                                    
                                    @if($job->benefits && count($job->benefits) > 0)
                                        <div class="flex flex-wrap gap-1 mb-3">
                                            @foreach(array_slice($job->benefits, 0, 3) as $benefit)
                                                <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs rounded-full border border-green-500/30">{{ $benefit }}</span>
                                            @endforeach
                                            @if(count($job->benefits) > 3)
                                                <span class="px-2 py-1 bg-slate-600/50 text-slate-400 text-xs rounded-full">+{{ count($job->benefits) - 3 }} más</span>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    @if($job->tags->count() > 0)
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @foreach($job->tags->take(4) as $tag)
                                        <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <div class="ml-4 flex flex-col space-y-2">
                                    <a href="{{ $job->url }}" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-4 py-2 rounded-lg text-sm transition-all transform hover:scale-105 flex items-center justify-center space-x-1">
                                        <span>Aplicar</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                    <button class="bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-4 py-2 rounded-lg text-sm transition-colors border border-slate-600/50">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-slate-700/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                        </div>
                        <p class="text-slate-400">No hay trabajos disponibles en este momento</p>
                    </div>
                @endif
            </div>

            <!-- Beneficios -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h2 class="text-xl font-bold text-white mb-6">Beneficios y Cultura</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3 p-4 bg-slate-700/20 rounded-xl">
                        <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white text-sm">Seguro médico privado</h3>
                            <p class="text-slate-400 text-xs mt-1">Cobertura completa para ti y tu familia</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-4 bg-slate-700/20 rounded-xl">
                        <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white text-sm">Horario flexible</h3>
                            <p class="text-slate-400 text-xs mt-1">Conciliación trabajo-vida personal</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-4 bg-slate-700/20 rounded-xl">
                        <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white text-sm">Formación continua</h3>
                            <p class="text-slate-400 text-xs mt-1">Cursos y certificaciones pagadas</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-4 bg-slate-700/20 rounded-xl">
                        <div class="w-8 h-8 bg-yellow-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white text-sm">Oficinas modernas</h3>
                            <p class="text-slate-400 text-xs mt-1">Espacios diseñados para la productividad</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Información de Contacto -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Información de Contacto</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9V3m0 18l-3-3m-3 3l3-3m0 0l-3-3m3 3l3-3"></path>
                        </svg>
                        <span class="text-slate-300 text-sm">www.empresa.com</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-slate-300 text-sm">careers@empresa.com</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-slate-300 text-sm">Calle Principal 123, Madrid</span>
                    </div>
                </div>
                
                <!-- Redes Sociales -->
                <div class="mt-6 pt-6 border-t border-slate-700/50">
                    <h4 class="text-white font-medium mb-3">Síguenos</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-blue-500/20 hover:bg-blue-500/30 rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-600/20 hover:bg-blue-600/30 rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-500/20 hover:bg-gray-500/30 rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Empresas Similares -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Empresas Similares</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 p-3 bg-slate-700/20 rounded-xl hover:bg-slate-700/30 transition-colors cursor-pointer">
                        <div class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center">
                            <span class="text-emerald-400 font-bold text-sm">T</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-white text-sm">TechCorp</h4>
                            <p class="text-slate-400 text-xs">12 trabajos activos</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 p-3 bg-slate-700/20 rounded-xl hover:bg-slate-700/30 transition-colors cursor-pointer">
                        <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                            <span class="text-purple-400 font-bold text-sm">I</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-white text-sm">InnovateLab</h4>
                            <p class="text-slate-400 text-xs">8 trabajos activos</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 p-3 bg-slate-700/20 rounded-xl hover:bg-slate-700/30 transition-colors cursor-pointer">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <span class="text-blue-400 font-bold text-sm">F</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-white text-sm">FutureTech</h4>
                            <p class="text-slate-400 text-xs">15 trabajos activos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection