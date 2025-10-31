<!-- Notificaciones Toast -->
<div id="notification-container" class="fixed top-4 right-4 z-50 space-y-2">
    <!-- Las notificaciones se añadirán aquí dinámicamente -->
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50">
    <div class="flex items-center justify-center h-full">
        <div class="bg-slate-800/90 backdrop-blur-xl rounded-2xl p-8 border border-slate-700/50 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto mb-4"></div>
            <p class="text-white font-medium">Cargando...</p>
        </div>
    </div>
</div>

<script>
class NotificationManager {
    constructor() {
        this.container = document.getElementById('notification-container');
    }

    show(message, type = 'info', duration = 5000) {
        const notification = this.createNotification(message, type);
        this.container.appendChild(notification);

        // Animación de entrada
        setTimeout(() => {
            notification.classList.remove('translate-x-full', 'opacity-0');
        }, 10);

        // Auto-remove
        if (duration > 0) {
            setTimeout(() => {
                this.remove(notification);
            }, duration);
        }

        return notification;
    }

    createNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `
            max-w-sm w-full bg-slate-800/95 backdrop-blur-xl border border-slate-700/50 rounded-xl shadow-lg 
            transform translate-x-full opacity-0 transition-all duration-300 ease-out
        `;

        const icons = {
            success: `<svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>`,
            error: `<svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>`,
            warning: `<svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>`,
            info: `<svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>`
        };

        const colors = {
            success: 'border-green-500/30 bg-green-500/10',
            error: 'border-red-500/30 bg-red-500/10',
            warning: 'border-yellow-500/30 bg-yellow-500/10',
            info: 'border-blue-500/30 bg-blue-500/10'
        };

        notification.innerHTML = `
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="p-1 rounded-lg ${colors[type]}">
                            ${icons[type]}
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-white">${message}</p>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        <button class="inline-flex text-slate-400 hover:text-slate-300 focus:outline-none" onclick="notificationManager.remove(this.closest('[class*=translate-x]'))">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;

        return notification;
    }

    remove(notification) {
        notification.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }

    success(message, duration = 5000) {
        return this.show(message, 'success', duration);
    }

    error(message, duration = 7000) {
        return this.show(message, 'error', duration);
    }

    warning(message, duration = 6000) {
        return this.show(message, 'warning', duration);
    }

    info(message, duration = 5000) {
        return this.show(message, 'info', duration);
    }
}

// Loading Manager
class LoadingManager {
    constructor() {
        this.overlay = document.getElementById('loading-overlay');
        this.isLoading = false;
    }

    show(message = 'Cargando...') {
        if (this.isLoading) return;
        
        this.isLoading = true;
        const loadingText = this.overlay.querySelector('p');
        if (loadingText) {
            loadingText.textContent = message;
        }
        this.overlay.classList.remove('hidden');
        this.overlay.classList.add('flex', 'items-center', 'justify-center');
    }

    hide() {
        this.isLoading = false;
        this.overlay.classList.add('hidden');
        this.overlay.classList.remove('flex', 'items-center', 'justify-center');
    }
}

// Instancias globales
const notificationManager = new NotificationManager();
const loadingManager = new LoadingManager();

// Auto-mostrar notificaciones desde Laravel
document.addEventListener('DOMContentLoaded', function() {
    // Success messages from Laravel
    @if(session('success'))
        notificationManager.success('{{ session('success') }}');
    @endif

    // Error messages from Laravel
    @if(session('error'))
        notificationManager.error('{{ session('error') }}');
    @endif

    // Warning messages from Laravel
    @if(session('warning'))
        notificationManager.warning('{{ session('warning') }}');
    @endif

    // Info messages from Laravel
    @if(session('info'))
        notificationManager.info('{{ session('info') }}');
    @endif

    // Validation errors
    @if($errors->any())
        @foreach($errors->all() as $error)
            notificationManager.error('{{ $error }}');
        @endforeach
    @endif
});

// Interceptar formularios para mostrar loading
document.addEventListener('submit', function(e) {
    if (e.target.tagName === 'FORM') {
        const submitButton = e.target.querySelector('button[type="submit"]');
        if (submitButton) {
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Procesando...
            `;
            
            // Restaurar después de 5 segundos como fallback
            setTimeout(() => {
                submitButton.disabled = false;
                submitButton.textContent = originalText;
            }, 5000);
        }
    }
});
</script>