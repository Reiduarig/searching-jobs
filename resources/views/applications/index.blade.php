<x-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">Mis Aplicaciones</h1>
                    <p class="text-slate-400">Gestiona y sigue el estado de tus aplicaciones de trabajo</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('jobs') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-4 py-2 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                        Buscar más trabajos
                    </a>
                </div>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-xl p-4 border border-slate-700/50">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-slate-400">Total</p>
                        <p class="text-xl font-bold text-white">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/40 backdrop-blur-sm rounded-xl p-4 border border-slate-700/50">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-slate-400">Pendientes</p>
                        <p class="text-xl font-bold text-white">{{ $stats['pending'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/40 backdrop-blur-sm rounded-xl p-4 border border-slate-700/50">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-slate-400">Entrevistas</p>
                        <p class="text-xl font-bold text-white">{{ $stats['interviewed'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/40 backdrop-blur-sm rounded-xl p-4 border border-slate-700/50">
                <div class="flex items-center">
                    <div class="p-2 bg-green-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-slate-400">Aceptadas</p>
                        <p class="text-xl font-bold text-white">{{ $stats['accepted'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/40 backdrop-blur-sm rounded-xl p-4 border border-slate-700/50">
                <div class="flex items-center">
                    <div class="p-2 bg-red-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-slate-400">Rechazadas</p>
                        <p class="text-xl font-bold text-white">{{ $stats['rejected'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros avanzados -->
        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <form method="GET" action="{{ route('applications.index') }}" class="space-y-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Filtros</h3>
                    <div class="flex space-x-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
                            Aplicar filtros
                        </button>
                        <a href="{{ route('applications.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-colors text-sm">
                            Limpiar
                        </a>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Filtro por estado -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-300 mb-2">Estado</label>
                        <select name="status" id="status" class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>Todos los estados</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendientes</option>
                            <option value="reviewed" {{ request('status') === 'reviewed' ? 'selected' : '' }}>Revisadas</option>
                            <option value="interviewed" {{ request('status') === 'interviewed' ? 'selected' : '' }}>Entrevistas</option>
                            <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Aceptadas</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rechazadas</option>
                        </select>
                    </div>

                    <!-- Filtro por empresa -->
                    <div>
                        <label for="company" class="block text-sm font-medium text-slate-300 mb-2">Empresa</label>
                        <select name="company" id="company" class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Todas las empresas</option>
                            @foreach($companies as $company)
                                <option value="{{ $company }}" {{ request('company') === $company ? 'selected' : '' }}>
                                    {{ $company }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por título del trabajo -->
                    <div>
                        <label for="job_title" class="block text-sm font-medium text-slate-300 mb-2">Título del trabajo</label>
                        <input type="text" name="job_title" id="job_title" value="{{ request('job_title') }}" 
                               placeholder="Buscar por título..."
                               class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-3 py-2 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Filtro por rango de fechas -->
                    <div>
                        <label for="date_range" class="block text-sm font-medium text-slate-300 mb-2">Período</label>
                        <select name="date_range" id="date_range" class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="all" {{ request('date_range', 'all') === 'all' ? 'selected' : '' }}>Todo el tiempo</option>
                            <option value="today" {{ request('date_range') === 'today' ? 'selected' : '' }}>Hoy</option>
                            <option value="week" {{ request('date_range') === 'week' ? 'selected' : '' }}>Última semana</option>
                            <option value="month" {{ request('date_range') === 'month' ? 'selected' : '' }}>Último mes</option>
                            <option value="3months" {{ request('date_range') === '3months' ? 'selected' : '' }}>Últimos 3 meses</option>
                        </select>
                    </div>
                </div>

                <!-- Filtros de fecha personalizados -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-slate-700/50">
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-slate-300 mb-2">Desde</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" 
                               class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="date_to" class="block text-sm font-medium text-slate-300 mb-2">Hasta</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" 
                               class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="sort_by" class="block text-sm font-medium text-slate-300 mb-2">Ordenar por</label>
                        <select name="sort_by" id="sort_by" class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="applied_at" {{ request('sort_by', 'applied_at') === 'applied_at' ? 'selected' : '' }}>Fecha de aplicación</option>
                            <option value="updated_at" {{ request('sort_by') === 'updated_at' ? 'selected' : '' }}>Última actualización</option>
                            <option value="status" {{ request('sort_by') === 'status' ? 'selected' : '' }}>Estado</option>
                        </select>
                        <input type="hidden" name="sort_order" value="{{ request('sort_order', 'desc') }}">
                    </div>
                </div>
            </form>
        </div>

        <!-- Lista de aplicaciones -->
        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50 overflow-hidden">
            <div class="p-6 border-b border-slate-700/50">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white">
                            @if(request()->hasAny(['status', 'company', 'job_title', 'date_range', 'date_from', 'date_to']) && 
                                (request('status') !== 'all' || request('company') || request('job_title') || request('date_range') !== 'all' || request('date_from') || request('date_to')))
                                Aplicaciones Filtradas
                            @else
                                Todas las Aplicaciones
                            @endif
                        </h2>
                        @if(request()->hasAny(['status', 'company', 'job_title', 'date_range', 'date_from', 'date_to']) && 
                            (request('status') !== 'all' || request('company') || request('job_title') || request('date_range') !== 'all' || request('date_from') || request('date_to')))
                            <p class="text-slate-400 text-sm mt-1">
                                Mostrando {{ $applications->total() }} resultado{{ $applications->total() !== 1 ? 's' : '' }}
                                @if(request('status') && request('status') !== 'all')
                                    • Estado: <span class="text-blue-400">{{ ucfirst(request('status')) }}</span>
                                @endif
                                @if(request('company'))
                                    • Empresa: <span class="text-blue-400">{{ request('company') }}</span>
                                @endif
                                @if(request('job_title'))
                                    • Trabajo: <span class="text-blue-400">"{{ request('job_title') }}"</span>
                                @endif
                            </p>
                        @endif
                    </div>
                    <div class="text-slate-400 text-sm">
                        {{ $applications->total() }} aplicación{{ $applications->total() !== 1 ? 'es' : '' }}
                    </div>
                </div>
            </div>

            @forelse($applications as $application)
                <div class="p-6 border-b border-slate-700/50 last:border-b-0 hover:bg-slate-700/20 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <!-- Logo de la empresa -->
                            <div class="flex-shrink-0">
                                <x-employer-logo :employer="$application->job->employer" size="12" />
                            </div>
                            
                            <!-- Información del trabajo -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-white truncate">
                                    {{ $application->job->title }}
                                </h3>
                                <p class="text-slate-400">
                                    {{ $application->job->employer->name }} • {{ $application->job->location }}
                                </p>
                                
                                <!-- Información de la aplicación -->
                                <div class="flex items-center space-x-4 mt-2 text-sm text-slate-500">
                                    <span>Aplicado el {{ $application->applied_at->format('d/m/Y') }}</span>
                                    @if($application->cover_letter)
                                        <span>• Con carta de presentación</span>
                                    @endif
                                    @if($application->cv_path)
                                        <span>• CV adjunto</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Estado y acciones -->
                        <div class="flex items-center space-x-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-{{ $application->status_color }}-500/20 text-{{ $application->status_color }}-400 border border-{{ $application->status_color }}-500/30">
                                {{ $application->status_label }}
                            </span>
                            
                            <div class="flex items-center space-x-1">
                                <!-- Ver detalles -->
                                <a href="{{ route('applications.show', $application) }}" class="p-2 text-slate-400 hover:text-blue-400 transition-colors" title="Ver detalles">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                
                                <!-- Cancelar (solo si está pendiente) -->
                                @if($application->status === 'pending')
                                    <form method="POST" action="{{ route('applications.destroy', $application) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres cancelar esta aplicación?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-400 transition-colors" title="Cancelar aplicación">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-white mb-2">No tienes aplicaciones aún</h3>
                    <p class="text-slate-400 mb-6">¡Empieza a aplicar a trabajos y construye tu carrera profesional!</p>
                    <a href="{{ route('jobs') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                        Explorar trabajos
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if($applications->hasPages())
            <div class="flex justify-center">
                {{ $applications->links() }}
            </div>
        @endif
    </div>

    <!-- JavaScript para mejorar la experiencia de filtros -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit cuando cambian los selectores
            const autoSubmitSelectors = ['#status', '#company', '#date_range'];
            autoSubmitSelectors.forEach(selector => {
                const element = document.querySelector(selector);
                if (element) {
                    element.addEventListener('change', function() {
                        // Si se selecciona un rango predefinido, limpiar fechas personalizadas
                        if (selector === '#date_range' && this.value !== 'all') {
                            document.querySelector('#date_from').value = '';
                            document.querySelector('#date_to').value = '';
                        }
                        this.form.submit();
                    });
                }
            });

            // Limpiar rango predefinido si se usan fechas personalizadas
            const customDateInputs = ['#date_from', '#date_to'];
            customDateInputs.forEach(selector => {
                const element = document.querySelector(selector);
                if (element) {
                    element.addEventListener('change', function() {
                        if (this.value) {
                            document.querySelector('#date_range').value = 'all';
                        }
                    });
                }
            });

            // Confirmar limpiar filtros si hay muchos filtros activos
            const clearButton = document.querySelector('a[href="{{ route('applications.index') }}"]');
            if (clearButton) {
                clearButton.addEventListener('click', function(e) {
                    const hasFilters = {{ request()->hasAny(['status', 'company', 'job_title', 'date_range', 'date_from', 'date_to']) && 
                        (request('status') !== 'all' || request('company') || request('job_title') || request('date_range') !== 'all' || request('date_from') || request('date_to')) ? 'true' : 'false' }};
                    
                    if (hasFilters) {
                        if (!confirm('¿Estás seguro de que quieres limpiar todos los filtros?')) {
                            e.preventDefault();
                        }
                    }
                });
            }

            // Funcionalidad para ordenamiento
            const sortSelect = document.querySelector('#sort_by');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }
        });
    </script>
</x-layout>