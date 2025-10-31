<x-layout>
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-user-tie mr-3 text-blue-400"></i>
                    Detalle de Aplicación
                </h1>
                <p class="text-slate-400 mt-1">{{ $application->job->title }} • {{ $application->user->name }}</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <a href="{{ route('employer.applications') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Volver a Aplicaciones</span>
                </a>
                <button onclick="openStatusModal({{ $application->id }}, '{{ $application->status }}')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                    <i class="fas fa-edit"></i>
                    <span>Cambiar Estado</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Información del Candidato -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Datos del Candidato -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <div class="flex items-center space-x-6 mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center">
                        <span class="text-3xl font-bold text-white">{{ substr($application->user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ $application->user->name }}</h2>
                        <p class="text-slate-400">{{ $application->user->email }}</p>
                        <div class="flex items-center space-x-4 mt-2">
                            <span class="text-slate-500 text-sm">
                                <i class="fas fa-calendar mr-1"></i>
                                Aplicó {{ $application->applied_at->diffForHumans() }}
                            </span>
                            <span class="text-slate-500 text-sm">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $application->applied_at->format('d M Y \a \l\a\s H:i') }}
                            </span>
                        </div>
                    </div>
                </div>

                @if($application->cover_letter)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-white mb-3">Carta de Presentación</h3>
                        <div class="bg-slate-700/30 rounded-xl p-4 border border-slate-600/30">
                            <p class="text-slate-300 leading-relaxed">{{ $application->cover_letter }}</p>
                        </div>
                    </div>
                @endif

                @if($application->cv_path)
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-3">Currículum Vitae</h3>
                        <div class="bg-slate-700/30 rounded-xl p-4 border border-slate-600/30">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-file-pdf text-red-400 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">CV - {{ $application->user->name }}</p>
                                        <p class="text-slate-400 text-sm">PDF • {{ number_format(\Illuminate\Support\Facades\Storage::size($application->cv_path) / 1024, 0) }} KB</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ \Illuminate\Support\Facades\Storage::url($application->cv_path) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                                        <i class="fas fa-eye"></i>
                                        <span>Ver</span>
                                    </a>
                                    <a href="{{ \Illuminate\Support\Facades\Storage::url($application->cv_path) }}" download class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                                        <i class="fas fa-download"></i>
                                        <span>Descargar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Historial de Estados -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-history mr-2 text-purple-400"></i>
                    Historial de la Aplicación
                </h3>
                <div class="space-y-4">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center mt-1">
                            <i class="fas fa-paper-plane text-blue-400 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-white">Aplicación Enviada</h4>
                                <span class="text-slate-400 text-sm">{{ $application->applied_at->format('d M Y H:i') }}</span>
                            </div>
                            <p class="text-slate-400 text-sm">El candidato envió su aplicación para este puesto</p>
                        </div>
                    </div>

                    @if($application->status !== 'pending')
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-yellow-500/20 rounded-full flex items-center justify-center mt-1">
                                @if($application->status === 'interviewed')
                                    <i class="fas fa-user-tie text-purple-400 text-sm"></i>
                                @elseif($application->status === 'accepted')
                                    <i class="fas fa-check text-green-400 text-sm"></i>
                                @else
                                    <i class="fas fa-times text-red-400 text-sm"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-medium text-white">
                                        @if($application->status === 'interviewed')
                                            Convocado a Entrevista
                                        @elseif($application->status === 'accepted')
                                            Aplicación Aceptada
                                        @else
                                            Aplicación Rechazada
                                        @endif
                                    </h4>
                                    <span class="text-slate-400 text-sm">{{ $application->updated_at->format('d M Y H:i') }}</span>
                                </div>
                                <p class="text-slate-400 text-sm">
                                    @if($application->status === 'interviewed')
                                        El candidato ha sido seleccionado para una entrevista
                                    @elseif($application->status === 'accepted')
                                        El candidato ha sido aceptado para el puesto
                                    @else
                                        La aplicación fue rechazada
                                    @endif
                                </p>
                                @if($application->employer_notes)
                                    <div class="mt-2 p-3 bg-slate-700/30 rounded-lg border border-slate-600/30">
                                        <p class="text-slate-300 text-sm">{{ $application->employer_notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Estado Actual -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-semibold text-white mb-4">Estado Actual</h3>
                
                <div class="text-center mb-4">
                    @if($application->status === 'pending')
                        <div class="w-16 h-16 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            Pendiente de Revisión
                        </span>
                    @elseif($application->status === 'interviewed')
                        <div class="w-16 h-16 bg-purple-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-user-tie text-purple-400 text-2xl"></i>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            Convocado a Entrevista
                        </span>
                    @elseif($application->status === 'accepted')
                        <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-check text-green-400 text-2xl"></i>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            Aplicación Aceptada
                        </span>
                    @else
                        <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-times text-red-400 text-2xl"></i>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            Aplicación Rechazada
                        </span>
                    @endif
                </div>

                <button onclick="openStatusModal({{ $application->id }}, '{{ $application->status }}')" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                    Cambiar Estado
                </button>
            </div>

            <!-- Información del Trabajo -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-semibold text-white mb-4">Detalles del Trabajo</h3>
                
                <div class="space-y-3">
                    <div>
                        <h4 class="text-white font-medium">{{ $application->job->title }}</h4>
                        <p class="text-slate-400 text-sm">{{ $application->job->location }} • {{ $application->job->type }}</p>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 text-sm">Salario:</span>
                        <span class="text-white text-sm font-medium">€{{ number_format($application->job->salary_min) }} - €{{ number_format($application->job->salary_max) }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 text-sm">Publicado:</span>
                        <span class="text-white text-sm">{{ $application->job->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 text-sm">Total aplicaciones:</span>
                        <span class="text-white text-sm font-medium">{{ $application->job->applications()->count() }}</span>
                    </div>
                </div>

                <a href="{{ route('employer.applications', ['job_id' => $application->job->id]) }}" class="w-full mt-4 bg-slate-700 hover:bg-slate-600 text-white py-2 px-4 rounded-lg font-medium transition-colors block text-center">
                    Ver Todas las Aplicaciones
                </a>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-semibold text-white mb-4">Acciones Rápidas</h3>
                
                <div class="space-y-3">
                    <button class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-lg transition-colors flex items-center space-x-3">
                        <i class="fas fa-envelope text-blue-400"></i>
                        <span class="text-slate-300 text-sm">Enviar Email</span>
                    </button>
                    
                    <button class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-lg transition-colors flex items-center space-x-3">
                        <i class="fas fa-calendar text-green-400"></i>
                        <span class="text-slate-300 text-sm">Programar Entrevista</span>
                    </button>
                    
                    <button class="w-full text-left p-3 bg-slate-700/30 hover:bg-slate-700/50 rounded-lg transition-colors flex items-center space-x-3">
                        <i class="fas fa-sticky-note text-yellow-400"></i>
                        <span class="text-slate-300 text-sm">Agregar Notas</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para cambiar estado -->
<div id="statusModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-slate-800 rounded-2xl p-6 w-full max-w-md mx-4 border border-slate-700">
        <h3 class="text-xl font-bold text-white mb-4">Cambiar Estado de Aplicación</h3>
        
        <form id="statusForm" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="space-y-4">
                <div>
                    <label for="modal_status" class="block text-sm font-medium text-slate-300 mb-2">Nuevo Estado</label>
                    <select name="status" id="modal_status" class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="pending">Pendiente</option>
                        <option value="interviewed">Convocar a Entrevista</option>
                        <option value="accepted">Aceptar</option>
                        <option value="rejected">Rechazar</option>
                    </select>
                </div>
                
                <div>
                    <label for="notes" class="block text-sm font-medium text-slate-300 mb-2">Notas (Opcional)</label>
                    <textarea name="notes" id="notes" rows="3" class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" placeholder="Comentarios adicionales...">{{ $application->employer_notes }}</textarea>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeStatusModal()" class="bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    Actualizar Estado
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openStatusModal(applicationId, currentStatus) {
    const modal = document.getElementById('statusModal');
    const form = document.getElementById('statusForm');
    const statusSelect = document.getElementById('modal_status');
    
    form.action = `/employer/applications/${applicationId}/status`;
    statusSelect.value = currentStatus;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeStatusModal() {
    const modal = document.getElementById('statusModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Cerrar modal al hacer clic fuera
document.getElementById('statusModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStatusModal();
    }
});
</script>
</x-layout>