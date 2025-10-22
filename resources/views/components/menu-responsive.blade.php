<div id="mobile-menu" class="md:hidden fixed inset-x-0 top-0 z-40 bg-slate-900/95 backdrop-blur-xl transform -translate-y-full transition-all duration-300 ease-in-out">
    <div class="pt-20 pb-6 px-4">
        <!-- Navegación móvil -->
        <nav class="space-y-1">
            <a href="{{ route('jobs') }}" class="block px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg font-medium transition-colors duration-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                    <span>Trabajos</span>
                </div>
            </a>
            <a href="#" class="block px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg font-medium transition-colors duration-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span>Carreras</span>
                </div>
            </a>
            <a href="#" class="block px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg font-medium transition-colors duration-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    <span>Salarios</span>
                </div>
            </a>
            <a href="#" class="block px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg font-medium transition-colors duration-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span>Compañías</span>
                </div>
            </a>
        </nav>

        <!-- Separador -->
        <div class="my-6 border-t border-slate-700/50"></div>

        <!-- Acciones del usuario móvil -->
        <div class="space-y-3">
            @auth
                <a href="/jobs/create" class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-4 py-3 rounded-lg transition-all duration-200 text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Publicar Trabajo</span>
                    </div>
                </a>
                <form method="POST" action="/logout" class="block w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-left px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg font-medium transition-colors duration-200">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Cerrar Sesión</span>
                        </div>
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="block w-full px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg font-medium transition-colors duration-200">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Iniciar Sesión</span>
                    </div>
                </a>
                <a href="{{ route('register') }}" class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-4 py-3 rounded-lg transition-all duration-200 text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        <span>Registrarse</span>
                    </div>
                </a>
            @endguest
        </div>

        <!-- Info adicional -->
        <div class="mt-8 pt-6 border-t border-slate-700/50">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-2">
                    <img src="/images/logo.svg" alt="Logo" class="h-6">
                    <span class="text-lg font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">JobSearch</span>
                </div>
                <p class="text-sm text-slate-400">Tu próximo trabajo te espera</p>
            </div>
        </div>
    </div>
</div>

<!-- Overlay para cerrar el menú -->
<div id="mobile-menu-overlay" class="md:hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-30 opacity-0 pointer-events-none transition-all duration-300"></div>
