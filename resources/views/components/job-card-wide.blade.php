@props([
    'job'
])

<x-panel class="group">
    <div class="flex flex-col md:flex-row gap-6 items-start">
        <!-- Logo y empresa -->
        <div class="flex items-center space-x-4 md:min-w-0 md:w-64">
            <div class="flex-shrink-0">
                <x-employer-logo :employer="$job->employer" :width="48" />
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="text-sm font-medium text-slate-300 truncate">{{ $job->employer->name }}</h4>
                <div class="flex items-center space-x-2 mt-1">
                    <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-xs text-slate-500">{{ $job->location ?? 'Remoto' }}</span>
                </div>
            </div>
        </div>

        <!-- Información principal del trabajo -->
        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between">
                <div class="min-w-0 flex-1 pr-4">
                    <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors duration-300 line-clamp-2 mb-2">
                        <a href="{{ route('jobs.show', $job) }}" class="block">
                            {{ $job->title }}
                        </a>
                    </h3>
                    
                    <!-- Información adicional -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-400 mb-3">
                        <!-- Salario -->
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            @if($job->salary_min && $job->salary_max)
                                <span class="font-semibold text-green-400">
                                    €{{ number_format($job->salary_min) }} - €{{ number_format($job->salary_max) }}
                                    @if($job->salary_period !== 'month') / {{ $job->salary_period === 'year' ? 'año' : $job->salary_period }} @endif
                                </span>
                            @elseif($job->salary_min)
                                <span class="font-semibold text-green-400">
                                    Desde €{{ number_format($job->salary_min) }}
                                    @if($job->salary_period !== 'month') / {{ $job->salary_period === 'year' ? 'año' : $job->salary_period }} @endif
                                </span>
                            @else
                                <span class="font-semibold text-slate-400">Salario a negociar</span>
                            @endif
                        </div>
                        
                        <!-- Tipo de contrato -->
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ ucfirst(str_replace('-', ' ', $job->schedule)) }}</span>
                            @if($job->duration)
                                <span class="text-slate-500">• {{ $job->duration }} meses</span>
                            @endif
                        </div>
                        
                        <!-- Fecha de publicación -->
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $job->created_at->diffForHumans() }}</span>
                        </div>

                        @if($job->experience_level)
                            <!-- Nivel de experiencia -->
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span>{{ ucfirst($job->experience_level) }}</span>
                            </div>
                        @endif

                        @if($job->urgent)
                            <!-- Urgente -->
                            <div class="flex items-center space-x-1 text-red-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="font-medium">URGENTE</span>
                            </div>
                        @endif
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2">
                        @foreach ($job->tags->take(4) as $tag)
                            <x-tag :tag="$tag" size="small" />     
                        @endforeach
                        @if($job->tags->count() > 4)
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-slate-700/50 text-slate-400">
                                +{{ $job->tags->count() - 4 }} más
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Acciones y badges -->
                <div class="flex flex-col items-end space-y-3">
                    @if($job->featured)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-yellow-500/20 to-orange-500/20 text-yellow-400 border border-yellow-500/30">
                            ⭐ Destacado
                        </span>
                    @endif

                    <!-- Botones de acción -->
                    <div class="flex space-x-2">
                        <x-save-button :job="$job" />
                        <button class="p-2 text-slate-400 hover:text-blue-400 hover:bg-blue-500/10 rounded-lg transition-colors" title="Compartir">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                        </button>
                        <x-apply-button :job="$job" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-panel>