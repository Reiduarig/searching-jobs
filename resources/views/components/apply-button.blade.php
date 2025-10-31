@props(['job'])

@auth
    @if(auth()->user()->isCandidate())
        @if(auth()->user()->hasAppliedTo($job))
            <!-- Ya aplicado -->
            <span class="inline-flex items-center px-2 py-1 bg-green-500/20 text-green-400 border border-green-500/30 rounded-md text-xs font-medium w-full justify-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Aplicado
            </span>
        @else
            <!-- Botón para aplicar -->
            <a 
                href="{{ route('jobs.show', $job) }}"
                class="inline-flex items-center px-2 py-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-md text-xs font-medium transition-all duration-200 hover:shadow-md w-full justify-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Aplicar
            </a>
        @endif
    @else
        <!-- Link a página de detalles para empleadores o visitantes -->
        <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center px-2 py-1 bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 hover:text-white border border-slate-600/50 rounded-md text-xs font-medium transition-colors w-full justify-center">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
            Ver detalles
        </a>
    @endif
@endauth

@guest
    <!-- Link a página de detalles para usuarios no autenticados -->
    <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center px-2 py-1 bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 hover:text-white border border-slate-600/50 rounded-md text-xs font-medium transition-colors w-full justify-center">
        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
        Ver detalles
    </a>
@endguest