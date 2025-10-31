<x-layout>
    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4">
        <div class="max-w-lg w-full">
            <!-- Header con logo -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <img src="/images/logo.svg" alt="JobSearch" class="h-12">
                </div>
                <h2 class="text-3xl font-bold text-white mb-2">Crear cuenta</h2>
                <p class="text-slate-400">Únete a la mejor plataforma de empleos</p>
            </div>

            <!-- Formulario -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-8 border border-slate-700/50">
                <x-forms.form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                    
                    <!-- Selector de tipo de cuenta -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white border-b border-slate-700/50 pb-2">Tipo de Cuenta</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Candidato -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="candidate" class="sr-only peer" checked>
                                <div class="p-4 rounded-xl border-2 border-slate-600/50 bg-slate-700/30 peer-checked:border-blue-500 peer-checked:bg-blue-500/10 transition-all hover:border-slate-500">
                                    <div class="flex flex-col items-center text-center space-y-2">
                                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-semibold text-white">Candidato</span>
                                        <span class="text-xs text-slate-400">Busco trabajo</span>
                                    </div>
                                </div>
                            </label>

                            <!-- Empleador -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="employer" class="sr-only peer">
                                <div class="p-4 rounded-xl border-2 border-slate-600/50 bg-slate-700/30 peer-checked:border-purple-500 peer-checked:bg-purple-500/10 transition-all hover:border-slate-500">
                                    <div class="flex flex-col items-center text-center space-y-2">
                                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        <span class="font-semibold text-white">Empleador</span>
                                        <span class="text-xs text-slate-400">Publico trabajos</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <x-forms.divider />

                    <!-- Información Personal -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white border-b border-slate-700/50 pb-2">Información Personal</h3>
                        
                        <x-forms.input 
                            label="Tu nombre" 
                            name="name" 
                            placeholder="Nombre completo"
                            required />
                        
                        <x-forms.input 
                            label="Tu correo electrónico" 
                            name="email" 
                            type="email"
                            placeholder="tu@email.com"
                            required />
                        
                        <x-forms.grid columns="2">
                            <x-forms.input 
                                label="Contraseña" 
                                name="password" 
                                type="password"
                                placeholder="••••••••"
                                description="Mínimo 8 caracteres"
                                required />
                            
                            <x-forms.input 
                                label="Confirma tu contraseña" 
                                name="password_confirmation" 
                                type="password"
                                placeholder="••••••••"
                                required />
                        </x-forms.grid>
                    </div>

                    <!-- Información de Empresa (solo para empleadores) -->
                    <div id="employer-fields" class="space-y-4" style="display: none;">
                        <x-forms.divider />
                        
                        <h3 class="text-lg font-semibold text-white border-b border-slate-700/50 pb-2">Información de Empresa</h3>
                        
                        <x-forms.input 
                            label="Nombre del empleador" 
                            name="employer"
                            placeholder="Nombre de tu empresa"
                            description="Indica el nombre de tu empresa u organización" />
                        
                        <x-forms.input 
                            label="Logo del empleador" 
                            name="logo_url" 
                            type="file"
                            description="Formatos aceptados: JPG, PNG, SVG (máx. 2MB)"
                            accept="image/*" />
                    </div>

                    <!-- Términos y condiciones -->
                    <div class="pt-4">
                        <x-forms.checkbox 
                            name="terms" 
                            label="Acepto los términos y condiciones"
                            variant="card"
                            required />
                        
                        <x-forms.checkbox 
                            name="newsletter" 
                            label="Recibir ofertas y noticias por email"
                            variant="card" />
                    </div>

                    <x-forms.button type="submit" class="w-full">
                        Crear cuenta
                    </x-forms.button>
                </x-forms.form>
            </div>

            <!-- Enlace de login -->
            <div class="text-center mt-8">
                <p class="text-slate-400">
                    ¿Ya tienes una cuenta? 
                    <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">
                        Iniciar sesión
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Manejar el cambio de tipo de cuenta
        document.addEventListener('DOMContentLoaded', function() {
            const roleInputs = document.querySelectorAll('input[name="role"]');
            const employerFields = document.getElementById('employer-fields');
            const employerInput = document.querySelector('input[name="employer"]');
            
            function toggleEmployerFields() {
                const selectedRole = document.querySelector('input[name="role"]:checked').value;
                
                if (selectedRole === 'employer') {
                    employerFields.style.display = 'block';
                    employerInput.setAttribute('required', 'required');
                } else {
                    employerFields.style.display = 'none';
                    employerInput.removeAttribute('required');
                }
            }
            
            // Configurar evento para todos los radio buttons
            roleInputs.forEach(input => {
                input.addEventListener('change', toggleEmployerFields);
            });
            
            // Configurar estado inicial
            toggleEmployerFields();
        });
    </script>
</x-layout>