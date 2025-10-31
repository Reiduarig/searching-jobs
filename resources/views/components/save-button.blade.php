@props(['job'])

@auth
    @if(auth()->user()->role === 'candidate')
        <button 
            onclick="toggleSaveJob({{ $job->id }})"
            id="save-btn-{{ $job->id }}"
            class="save-job-btn inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 transition-colors duration-200"
            data-job-id="{{ $job->id }}"
            data-saved="{{ auth()->user()->hasSaved($job) ? 'true' : 'false' }}"
            title="{{ auth()->user()->hasSaved($job) ? 'Quitar de favoritos' : 'Guardar en favoritos' }}"
        >
            <svg 
                class="w-4 h-4 {{ auth()->user()->hasSaved($job) ? 'text-red-500 fill-current' : 'text-gray-400' }}" 
                fill="{{ auth()->user()->hasSaved($job) ? 'currentColor' : 'none' }}" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </button>
    @endif
@endauth

<script>
function toggleSaveJob(jobId) {
    const btn = document.getElementById(`save-btn-${jobId}`);
    const icon = btn.querySelector('svg');
    const originalText = btn.title;
    
    // Deshabilitar botón durante la petición
    btn.disabled = true;
    btn.style.opacity = '0.6';
    
    fetch(`/jobs/${jobId}/toggle-save`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar el estado visual del botón
            if (data.saved) {
                icon.classList.add('text-red-500', 'fill-current');
                icon.classList.remove('text-gray-400');
                icon.setAttribute('fill', 'currentColor');
                btn.title = 'Quitar de favoritos';
                btn.setAttribute('data-saved', 'true');
            } else {
                icon.classList.remove('text-red-500', 'fill-current');
                icon.classList.add('text-gray-400');
                icon.setAttribute('fill', 'none');
                btn.title = 'Guardar en favoritos';
                btn.setAttribute('data-saved', 'false');
            }
            
            // Mostrar notificación
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error al procesar la solicitud', 'error');
    })
    .finally(() => {
        // Rehabilitar botón
        btn.disabled = false;
        btn.style.opacity = '1';
    });
}

function showNotification(message, type) {
    // Si ya existe una notificación, la removemos
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    const notification = document.createElement('div');
    notification.className = `notification fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Remover la notificación después de 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>