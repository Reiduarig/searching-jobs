<!-- Modal de aplicación global -->
@auth
    @if(auth()->user()->isCandidate())
        <div id="applicationModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 p-4">
            <div class="flex items-center justify-center h-full">
                <div class="bg-slate-800/95 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50 max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 id="modalTitle" class="text-xl font-bold text-white">Aplicar al trabajo</h3>
                        <button onclick="closeApplicationModal()" class="text-slate-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <form id="applicationForm" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" id="jobId" name="job_id">
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Carta de presentación (opcional)</label>
                            <textarea 
                                name="cover_letter" 
                                rows="4" 
                                class="w-full px-3 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-colors resize-none"
                                placeholder="Cuéntanos por qué eres el candidato ideal para este puesto..."
                                maxlength="2000"></textarea>
                            <p class="text-xs text-slate-500 mt-1">Máximo 2000 caracteres</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">CV (opcional)</label>
                            <input 
                                type="file" 
                                name="cv_file" 
                                accept=".pdf,.doc,.docx"
                                class="w-full px-3 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                            <p class="text-xs text-slate-500 mt-1">Formatos: PDF, DOC, DOCX (máx. 5MB)</p>
                        </div>
                        
                        <div class="flex space-x-3 pt-4">
                            <button 
                                type="button" 
                                onclick="closeApplicationModal()"
                                class="flex-1 px-4 py-2 bg-slate-700/50 text-slate-300 hover:text-white border border-slate-600/50 rounded-lg transition-colors">
                                Cancelar
                            </button>
                            <button 
                                type="submit"
                                class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all">
                                Enviar aplicación
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endauth

<script>
function openApplicationModal(jobId, jobTitle, companyName) {
    document.getElementById('jobId').value = jobId;
    const modal = document.getElementById('applicationModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Actualizar título del modal
    const modalTitle = document.getElementById('modalTitle');
    modalTitle.textContent = `Aplicar a ${jobTitle} en ${companyName}`;
}

function closeApplicationModal() {
    const modal = document.getElementById('applicationModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    // Limpiar formulario
    document.getElementById('applicationForm').reset();
    // Restaurar título original
    document.getElementById('modalTitle').textContent = 'Aplicar al trabajo';
}

// Manejar envío del formulario
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('applicationForm');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const jobId = document.getElementById('jobId').value;
            const formData = new FormData(this);
            
            try {
                loadingManager.show('Enviando aplicación...');
                
                const response = await fetch(`/jobs/${jobId}/apply`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                if (response.ok) {
                    notificationManager.success('¡Aplicación enviada exitosamente!');
                    closeApplicationModal();
                    // Recargar la página para actualizar el botón
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    notificationManager.error('Error al enviar la aplicación. Inténtalo de nuevo.');
                }
            } catch (error) {
                notificationManager.error('Error de conexión. Verifica tu internet.');
            } finally {
                loadingManager.hide();
            }
        });
    }
});

// Cerrar modal con ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeApplicationModal();
    }
});
</script>