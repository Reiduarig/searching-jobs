@props([
    'job'
])

<x-panel class="flex flex-col h-full">
    <!-- Header con empresa -->
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-3">
            <x-employer-logo :employer="$job->employer" :width="32" />
            <div>
                <div class="text-sm font-medium text-slate-300">{{ $job->employer->name }}</div>
                <div class="text-xs text-slate-400">{{ $job->location ?? 'Remoto' }}</div>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <x-save-button :job="$job" />
            @if($job->featured)
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-yellow-500/20 to-orange-500/20 text-yellow-400 border border-yellow-500/30">
                    ⭐ Destacado
                </span>
            @endif
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="flex-1 space-y-3">
        <h3 class="group-hover:text-blue-400 text-lg font-bold transition-colors duration-300 line-clamp-2">
            <a href="{{ route('jobs.show', $job) }}" class="block">
                {{ $job->title }}
            </a>
        </h3>
        
        <div class="flex items-center space-x-4 text-sm text-slate-400">
            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ ucfirst($job->schedule) }}</span>
                @if($job->duration)
                    <span class="text-slate-500">• {{ $job->duration }} meses</span>
                @endif
            </div>
            @if($job->urgent)
                <div class="flex items-center space-x-1 text-red-400">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-xs font-medium">URGENTE</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer con tags y botón -->
    <div class="mt-4 pt-4 border-t border-slate-700/50">
        <!-- Tags -->
        <div class="flex flex-wrap gap-1 mb-3">
            @foreach ($job->tags->take(3) as $tag)
                <x-tag :tag="$tag" size="small" />     
            @endforeach
            @if($job->tags->count() > 3)
                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-slate-700/50 text-slate-400">
                    +{{ $job->tags->count() - 3 }} más
                </span>
            @endif
        </div>
        
        <!-- Botón de aplicación compacto -->
        <x-apply-button :job="$job" />
    </div>
</x-panel>