<x-layout>
    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">
            <!-- Header con logo -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <img src="/images/logo.svg" alt="JobSearch" class="h-12">
                </div>
                <h2 class="text-3xl font-bold text-white mb-2">Bienvenido de vuelta</h2>
                <p class="text-slate-400">Accede a tu cuenta para continuar</p>
            </div>

            <!-- Formulario -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-8 border border-slate-700/50">
                <x-forms.form method="POST" action="{{ route('login') }}" class="space-y-6">
                    <!-- Email con icono -->
                    <div class="relative">
                        <x-forms.input 
                            name="email" 
                            label="Correo Electrónico" 
                            type="email"
                            placeholder="tu@email.com"
                            class="pl-10"
                            required />
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-7">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Contraseña con icono y toggle -->
                    <div class="relative">
                        <x-forms.input 
                            name="password" 
                            label="Contraseña" 
                            type="password"
                            placeholder="••••••••"
                            class="pl-10 pr-12"
                            required />
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-7">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-300 mt-7">
                            <svg id="eye-open" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eye-closed" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Recordar contraseña y enlace de recuperación -->
                    <div class="flex items-center justify-between">
                        <x-forms.checkbox 
                            name="remember" 
                            label="Recordarme" />
                        <a href="#" class="text-sm text-blue-400 hover:text-blue-300 transition-colors">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Botón de envío -->
                    <x-forms.button type="submit" class="w-full">
                        Iniciar Sesión
                    </x-forms.button>
                </x-forms.form>

                <!-- Separador -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-700/50"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-slate-800/40 text-slate-400">o continúa con</span>
                        </div>
                    </div>
                </div>

                <!-- Botones de redes sociales -->
                <div class="mt-6 grid grid-cols-2 gap-3">
                    <button class="w-full inline-flex justify-center py-3 px-4 border border-slate-600/50 rounded-xl bg-slate-700/30 text-sm font-medium text-slate-300 hover:bg-slate-700/50 hover:text-white transition-all">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="ml-2">Google</span>
                    </button>
                    <button class="w-full inline-flex justify-center py-3 px-4 border border-slate-600/50 rounded-xl bg-slate-700/30 text-sm font-medium text-slate-300 hover:bg-slate-700/50 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        <span class="ml-2">LinkedIn</span>
                    </button>
                </div>
            </div>

            <!-- Enlace de registro -->
            <div class="text-center mt-8">
                <p class="text-slate-400">
                    ¿No tienes una cuenta? 
                    <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">
                        Regístrate gratis
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        });
    </script>
</x-layout>