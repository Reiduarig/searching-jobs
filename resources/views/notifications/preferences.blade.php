<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencias de Notificaciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50">
    <nav class="bg-white shadow-sm border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-slate-900">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver al Dashboard
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-slate-700">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-slate-600 hover:text-slate-900">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h1 class="text-2xl font-semibold text-slate-900">
                    <i class="fas fa-bell mr-3 text-blue-600"></i>
                    Preferencias de Notificaciones
                </h1>
                <p class="mt-2 text-slate-600">Gestiona cómo y cuándo quieres recibir notificaciones por email.</p>
            </div>

            @if(session('success'))
                <div class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span class="text-green-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('notifications.update') }}" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    @if(Auth::user()->isEmployer())
                        <div class="flex items-start space-x-3">
                            <div class="flex items-center h-5">
                                <input 
                                    id="new_applications" 
                                    name="new_applications" 
                                    type="checkbox" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    {{ $preferences['new_applications'] ? 'checked' : '' }}
                                >
                            </div>
                            <div class="flex-1">
                                <label for="new_applications" class="font-medium text-slate-900">
                                    Nuevas Aplicaciones
                                </label>
                                <p class="text-slate-600 text-sm">
                                    Recibir notificaciones cuando los candidatos apliquen a tus empleos publicados.
                                </p>
                            </div>
                            <i class="fas fa-user-plus text-slate-400 mt-1"></i>
                        </div>
                    @endif

                    @if(Auth::user()->isCandidate())
                        <div class="flex items-start space-x-3">
                            <div class="flex items-center h-5">
                                <input 
                                    id="status_changes" 
                                    name="status_changes" 
                                    type="checkbox" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    {{ $preferences['status_changes'] ? 'checked' : '' }}
                                >
                            </div>
                            <div class="flex-1">
                                <label for="status_changes" class="font-medium text-slate-900">
                                    Cambios de Estado de Aplicaciones
                                </label>
                                <p class="text-slate-600 text-sm">
                                    Recibir notificaciones cuando el estado de tus aplicaciones cambie (en revisión, aceptada, rechazada).
                                </p>
                            </div>
                            <i class="fas fa-sync-alt text-slate-400 mt-1"></i>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="flex items-center h-5">
                                <input 
                                    id="job_recommendations" 
                                    name="job_recommendations" 
                                    type="checkbox" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    {{ $preferences['job_recommendations'] ? 'checked' : '' }}
                                >
                            </div>
                            <div class="flex-1">
                                <label for="job_recommendations" class="font-medium text-slate-900">
                                    Recomendaciones de Empleos
                                </label>
                                <p class="text-slate-600 text-sm">
                                    Recibir sugerencias de empleos que podrían interesarte basadas en tu perfil y actividad.
                                </p>
                            </div>
                            <i class="fas fa-lightbulb text-slate-400 mt-1"></i>
                        </div>
                    @endif

                    <div class="flex items-start space-x-3">
                        <div class="flex items-center h-5">
                            <input 
                                id="marketing" 
                                name="marketing" 
                                type="checkbox" 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                {{ $preferences['marketing'] ? 'checked' : '' }}
                            >
                        </div>
                        <div class="flex-1">
                            <label for="marketing" class="font-medium text-slate-900">
                                Comunicaciones de Marketing
                            </label>
                            <p class="text-slate-600 text-sm">
                                Recibir newsletters, actualizaciones de la plataforma y contenido promocional.
                            </p>
                        </div>
                        <i class="fas fa-envelope text-slate-400 mt-1"></i>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-slate-600">
                            <i class="fas fa-info-circle mr-1"></i>
                            Los cambios se aplicarán inmediatamente
                        </div>
                        <button 
                            type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200"
                        >
                            <i class="fas fa-save mr-2"></i>
                            Guardar Preferencias
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-8 bg-slate-100 rounded-lg p-6">
            <h3 class="font-medium text-slate-900 mb-3">
                <i class="fas fa-shield-alt mr-2 text-slate-600"></i>
                Privacidad y Configuración
            </h3>
            <div class="space-y-3 text-sm text-slate-600">
                <p>
                    <i class="fas fa-check mr-2 text-green-600"></i>
                    Tus preferencias de notificación son privadas y solo las usamos para enviarte emails relevantes.
                </p>
                <p>
                    <i class="fas fa-check mr-2 text-green-600"></i>
                    Puedes cambiar estas configuraciones en cualquier momento.
                </p>
                <p>
                    <i class="fas fa-check mr-2 text-green-600"></i>
                    También puedes darte de baja de cualquier email usando el enlace incluido en cada mensaje.
                </p>
            </div>
        </div>
    </div>
</body>
</html>