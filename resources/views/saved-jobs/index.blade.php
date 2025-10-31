<x-layout>
    <x-slot:heading>Trabajos Guardados</x-slot:heading>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Mis Trabajos Favoritos</h1>
        <p class="text-slate-400 mt-2">Gestiona los trabajos que has guardado para revisar más tarde</p>
    </div>

    @if($savedJobs->isEmpty())
        <!-- Estado vacío -->
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-12 text-center">
            <svg class="w-16 h-16 text-slate-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-white mb-2">No tienes trabajos guardados</h3>
            <p class="text-slate-400 mb-6">Cuando encuentres trabajos interesantes, puedes guardarlos haciendo clic en el ícono de corazón</p>
            <a href="{{ route('jobs') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Explorar Trabajos
            </a>
        </div>
    @else
        <!-- Lista de trabajos guardados -->
        <div class="space-y-6">
            @foreach($savedJobs as $savedJob)
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:border-slate-600/50 transition-all duration-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center space-x-3">
                            <x-employer-logo :employer="$savedJob->job->employer" :width="40" />
                            <div>
                                <h3 class="text-lg font-semibold text-white hover:text-blue-400 transition-colors">
                                    <a href="{{ $savedJob->job->url }}" target="_blank" rel="noopener noreferrer">
                                        {{ $savedJob->job->title }}
                                    </a>
                                </h3>
                                <p class="text-slate-400 text-sm">{{ $savedJob->job->employer->name }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-slate-500">
                                Guardado {{ $savedJob->saved_at->diffForHumans() }}
                            </span>
                            <button 
                                onclick="toggleSaveJob({{ $savedJob->job->id }})"
                                class="p-2 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition-colors"
                                title="Quitar de favoritos"
                            >
                                <svg class="w-5 h-5 fill-current" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Información del trabajo -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="flex items-center space-x-2 text-sm text-slate-400">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            @if($savedJob->job->salary_min && $savedJob->job->salary_max)
                                <span class="font-semibold text-green-400">
                                    €{{ number_format($savedJob->job->salary_min) }} - €{{ number_format($savedJob->job->salary_max) }}
                                </span>
                            @elseif($savedJob->job->salary_min)
                                <span class="font-semibold text-green-400">
                                    Desde €{{ number_format($savedJob->job->salary_min) }}
                                </span>
                            @else
                                <span class="font-semibold text-slate-400">Salario a negociar</span>
                            @endif
                        </div>

                        <div class="flex items-center space-x-2 text-sm text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $savedJob->job->location ?? 'Remoto' }}</span>
                        </div>

                        <div class="flex items-center space-x-2 text-sm text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ ucfirst($savedJob->job->schedule) }}</span>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach ($savedJob->job->tags->take(5) as $tag)
                            <x-tag :tag="$tag" size="small" />     
                        @endforeach
                        @if($savedJob->job->tags->count() > 5)
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-slate-700/50 text-slate-400">
                                +{{ $savedJob->job->tags->count() - 5 }} más
                            </span>
                        @endif
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex items-center justify-between pt-4 border-t border-slate-700/50">
                        <div class="flex space-x-3">
                            <x-apply-button :job="$savedJob->job" />
                            <a href="{{ $savedJob->job->url }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="inline-flex items-center px-4 py-2 text-slate-400 hover:text-white border border-slate-600 hover:border-slate-500 rounded-lg transition-colors text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Ver Detalles
                            </a>
                        </div>

                        @if($savedJob->job->featured || $savedJob->job->urgent)
                            <div class="flex space-x-2">
                                @if($savedJob->job->featured)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-yellow-500/20 to-orange-500/20 text-yellow-400 border border-yellow-500/30">
                                        ⭐ Destacado
                                    </span>
                                @endif
                                @if($savedJob->job->urgent)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-red-500/20 to-pink-500/20 text-red-400 border border-red-500/30">
                                        ⚡ Urgente
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        @if($savedJobs->hasPages())
            <div class="mt-8">
                {{ $savedJobs->links() }}
            </div>
        @endif
    @endif

    <!-- JavaScript para manejar favoritos -->
    <script>
        function toggleSaveJob(jobId) {
            fetch(`/jobs/${jobId}/toggle-save`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && !data.saved) {
                    // Si se quitó de favoritos, recargar la página
                    location.reload();
                }
                showNotification(data.message, data.success ? 'success' : 'error');
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error al procesar la solicitud', 'error');
            });
        }

        function showNotification(message, type) {
            const existingNotification = document.querySelector('.notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            const notification = document.createElement('div');
            notification.className = `notification fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
</x-layout>