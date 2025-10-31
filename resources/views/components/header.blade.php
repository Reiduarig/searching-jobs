<header class="sticky top-0 backdrop-blur-xl bg-slate-900/80 border-b border-slate-700/50 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('jobs') }}" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                    <img src="/images/logo.svg" alt="Logo de búsqueda de empleo" class="h-10">
                    <span class="hidden sm:block text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">JobSearch</span>
                </a>
            </div>
            
            <!-- Navegación principal -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('jobs') }}" class="text-slate-300 hover:text-white font-medium transition-colors duration-200 hover:bg-slate-800/50 px-3 py-2 rounded-lg">
                    Trabajos
                </a>
                <a href="#" class="text-slate-300 hover:text-white font-medium transition-colors duration-200 hover:bg-slate-800/50 px-3 py-2 rounded-lg">
                    Carreras
                </a>
                <a href="#" class="text-slate-300 hover:text-white font-medium transition-colors duration-200 hover:bg-slate-800/50 px-3 py-2 rounded-lg">
                    Salarios
                </a>
                <a href="#" class="text-slate-300 hover:text-white font-medium transition-colors duration-200 hover:bg-slate-800/50 px-3 py-2 rounded-lg">
                    Compañías
                </a>
            </div>

            <!-- Acciones del usuario -->
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <!-- Dashboard link -->
                        <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-white font-medium transition-colors duration-200 hover:bg-slate-800/50 px-3 py-2 rounded-lg flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V5a2 2 0 012-2h14a2 2 0 012 2v2"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                        
                        @if(auth()->user()->isCandidate())
                            <!-- Los candidatos acceden a aplicaciones y favoritos desde el dashboard -->
                        @endif
                        
                        @if(auth()->user()->isEmployer())
                            <a href="/jobs/create" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-4 py-2 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                                Publicar Trabajo
                            </a>
                        @endif
                        
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-300 hover:text-white font-medium transition-colors duration-200 hover:bg-slate-800/50 px-3 py-2 rounded-lg">
                                Cerrar Sesión
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="text-slate-300 hover:text-white font-medium transition-colors duration-200 hover:bg-slate-800/50 px-3 py-2 rounded-lg">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-4 py-2 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                            Registrarse
                        </a>
                    @endguest
                </div>
                <!-- Menú móvil -->
                <button id="mobile-menu-button" class="md:hidden text-slate-300 hover:text-white p-2 rounded-lg hover:bg-slate-800/50 transition-colors">
                    <svg id="menu-icon" class="w-6 h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </div>
</header>