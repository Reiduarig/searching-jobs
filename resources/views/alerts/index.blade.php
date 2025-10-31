@extends('components.layout')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Alertas de Trabajo</h1>
                <p class="text-slate-400 mt-1">Configura alertas personalizadas y recibe notificaciones de nuevos trabajos</p>
            </div>
            <button class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-3 rounded-xl transition-all transform hover:scale-105">
                + Nueva Alerta
            </button>
        </div>
    </div>

    <!-- Estadísticas de Alertas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-blue-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 17h-7l7-7 7 7H11z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Alertas Activas</p>
                    <p class="text-2xl font-bold text-white">5</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-emerald-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Enviados Hoy</p>
                    <p class="text-2xl font-bold text-white">12</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-purple-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Trabajos Encontrados</p>
                    <p class="text-2xl font-bold text-white">28</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-500/20 rounded-xl">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-slate-400 text-sm">Aplicaciones</p>
                    <p class="text-2xl font-bold text-white">8</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Lista de Alertas -->
        <div class="lg:col-span-2">
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white">Mis Alertas</h2>
                    <div class="flex space-x-2">
                        <button class="text-slate-400 hover:text-white text-sm">Filtrar</button>
                        <button class="text-slate-400 hover:text-white text-sm">Ordenar</button>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Alerta 1 -->
                    <div class="p-4 bg-slate-700/30 rounded-xl border border-slate-600/30">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="font-semibold text-white">Frontend Developer - React</h3>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                        Activa
                                    </span>
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-slate-400 mb-3">
                                    <span>Madrid</span>
                                    <span>€50k - €70k</span>
                                    <span>Remoto</span>
                                </div>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">React</span>
                                    <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">JavaScript</span>
                                    <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">TypeScript</span>
                                </div>
                                <div class="flex items-center space-x-6 text-sm">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                        </svg>
                                        <span class="text-slate-300">12 trabajos encontrados</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-slate-300">Última alerta: Hace 2 horas</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="p-2 text-slate-400 hover:text-white hover:bg-slate-600/50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Alerta 2 -->
                    <div class="p-4 bg-slate-700/30 rounded-xl border border-slate-600/30">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="font-semibold text-white">Backend Developer - Node.js</h3>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                        Pausada
                                    </span>
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-slate-400 mb-3">
                                    <span>Barcelona</span>
                                    <span>€45k - €65k</span>
                                    <span>Híbrido</span>
                                </div>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">Node.js</span>
                                    <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">Express</span>
                                    <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">MongoDB</span>
                                </div>
                                <div class="flex items-center space-x-6 text-sm">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                        </svg>
                                        <span class="text-slate-300">8 trabajos encontrados</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-slate-500">Pausada desde hace 3 días</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="p-2 text-slate-400 hover:text-white hover:bg-slate-600/50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M12 5v.01M12 19v.01M12 12v.01"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-white hover:bg-slate-600/50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Alerta 3 -->
                    <div class="p-4 bg-slate-700/30 rounded-xl border border-slate-600/30">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="font-semibold text-white">Full Stack Developer</h3>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                        Activa
                                    </span>
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-slate-400 mb-3">
                                    <span>Valencia</span>
                                    <span>€40k - €60k</span>
                                    <span>Presencial</span>
                                </div>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">Laravel</span>
                                    <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">Vue.js</span>
                                    <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">MySQL</span>
                                </div>
                                <div class="flex items-center space-x-6 text-sm">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                        </svg>
                                        <span class="text-slate-300">6 trabajos encontrados</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-slate-300">Última alerta: Hace 1 día</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="p-2 text-slate-400 hover:text-white hover:bg-slate-600/50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-slate-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Crear Nueva Alerta -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Crear Nueva Alerta</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Palabras clave</label>
                        <input type="text" 
                               placeholder="ej. React, Frontend, JavaScript"
                               class="w-full bg-slate-700/30 border border-slate-600 rounded-lg px-3 py-2 text-white placeholder-slate-400 focus:border-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Ubicación</label>
                        <select class="w-full bg-slate-700/30 border border-slate-600 rounded-lg px-3 py-2 text-white focus:border-blue-500 focus:outline-none">
                            <option value="">Todas las ubicaciones</option>
                            <option value="madrid">Madrid</option>
                            <option value="barcelona">Barcelona</option>
                            <option value="valencia">Valencia</option>
                            <option value="remoto">Remoto</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Salario mínimo</label>
                        <select class="w-full bg-slate-700/30 border border-slate-600 rounded-lg px-3 py-2 text-white focus:border-blue-500 focus:outline-none">
                            <option value="">Sin mínimo</option>
                            <option value="30000">€30,000+</option>
                            <option value="40000">€40,000+</option>
                            <option value="50000">€50,000+</option>
                            <option value="60000">€60,000+</option>
                            <option value="70000">€70,000+</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Frecuencia</label>
                        <select class="w-full bg-slate-700/30 border border-slate-600 rounded-lg px-3 py-2 text-white focus:border-blue-500 focus:outline-none">
                            <option value="instant">Inmediata</option>
                            <option value="daily">Diaria</option>
                            <option value="weekly">Semanal</option>
                        </select>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="email_notifications" class="rounded border-slate-600 text-blue-600 focus:ring-blue-500">
                        <label for="email_notifications" class="ml-2 text-sm text-slate-300">Recibir por email</label>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-2 px-4 rounded-lg transition-all">
                        Crear Alerta
                    </button>
                </form>
            </div>

            <!-- Configuración de Notificaciones -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Configuración</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Notificaciones push</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Emails diarios</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Resumen semanal</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">SMS urgentes</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Esta Semana</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Trabajos nuevos</span>
                        <span class="text-emerald-400 font-medium">+24</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Alertas enviadas</span>
                        <span class="text-blue-400 font-medium">156</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Aplicaciones realizadas</span>
                        <span class="text-purple-400 font-medium">8</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 text-sm">Tasa de acierto</span>
                        <span class="text-yellow-400 font-medium">85%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection