<x-layout>
<div class="max-w-6xl mx-auto space-y-8">
    <!-- Header del Trabajo -->
    <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-2xl p-8 border border-slate-700/50">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
            <div class="flex-1">
                <div class="flex items-center space-x-4 mb-4">
                    <x-employer-logo :employer="$job->employer" :width="64" />
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $job->title }}</h1>
                        <p class="text-xl text-slate-300">{{ $job->employer->name }}</p>
                        <div class="flex items-center space-x-4 mt-2 text-slate-400">
                            <span><i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location }}</span>
                            <span><i class="fas fa-briefcase mr-1"></i>{{ ucfirst($job->schedule) }}</span>
                            <span><i class="fas fa-clock mr-1"></i>{{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Tags y Badges -->
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    @if($job->featured)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                            <i class="fas fa-star mr-1"></i>
                            Destacado
                        </span>
                    @endif
                    @if($job->urgent)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-500/20 text-red-400 border border-red-500/30">
                            <i class="fas fa-exclamation mr-1"></i>
                            Urgente
                        </span>
                    @endif
                    @foreach($job->tags as $tag)
                        <span class="px-3 py-1 bg-slate-700/50 text-slate-300 rounded-full text-sm border border-slate-600/50">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
                
                <!-- Información de Salario -->
                <div class="text-2xl font-bold text-emerald-400">
                    €{{ number_format($job->salary_min) }} - €{{ number_format($job->salary_max) }}
                    <span class="text-lg text-slate-400">/ {{ $job->salary_period }}</span>
                </div>
            </div>
            
            <!-- Acciones -->
            <div class="flex flex-col space-y-3 lg:items-end">
                @auth
                    @if(Auth::user()->isCandidate())
                        <!-- Botón de Aplicar -->
                        @if($hasApplied)
                            <div class="bg-green-500/20 text-green-400 px-6 py-3 rounded-lg border border-green-500/30 text-center">
                                <i class="fas fa-check mr-2"></i>
                                Ya aplicaste a este trabajo
                            </div>
                        @else
                            <a href="#application-form" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-3 rounded-lg font-medium transition-all transform hover:scale-105 text-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Aplicar Ahora
                            </a>
                        @endif
                        
                        <!-- Botón Guardar -->
                        <form method="POST" action="{{ route('saved-jobs.toggle', $job) }}" class="inline">
                            @csrf
                            <button type="submit" class="w-full bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white px-6 py-3 rounded-lg transition-colors border border-slate-600/50">
                                @if($isSaved)
                                    <i class="fas fa-heart mr-2 text-red-400"></i>
                                    Guardado
                                @else
                                    <i class="far fa-heart mr-2"></i>
                                    Guardar Trabajo
                                @endif
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-3 rounded-lg font-medium transition-all text-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Inicia Sesión para Aplicar
                    </a>
                @endauth
                
                <!-- Información adicional -->
                <div class="text-slate-400 text-sm text-right">
                    <div>{{ $job->applications->count() }} {{ Str::plural('aplicación', $job->applications->count()) }}</div>
                    <div>Publicado {{ $job->created_at->format('d M Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Contenido Principal -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Descripción del Trabajo -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h2 class="text-2xl font-bold text-white mb-4">Descripción del Trabajo</h2>
                <div class="prose prose-slate prose-invert max-w-none">
                    {!! nl2br(e($job->description)) !!}
                </div>
            </div>

            <!-- Beneficios -->
            @if($job->benefits && count($job->benefits) > 0)
                <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                    <h2 class="text-2xl font-bold text-white mb-4">
                        <i class="fas fa-gift mr-2 text-emerald-400"></i>
                        Beneficios
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($job->benefits as $benefit)
                            <div class="flex items-center space-x-3 p-3 bg-slate-700/30 rounded-lg border border-slate-600/30">
                                <i class="fas fa-check text-emerald-400"></i>
                                <span class="text-slate-300">{{ $benefit }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Formulario de Aplicación -->
            @auth
                @if(Auth::user()->isCandidate() && !$hasApplied)
                    <div id="application-form" class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                        <h2 class="text-2xl font-bold text-white mb-6">
                            <i class="fas fa-paper-plane mr-2 text-blue-400"></i>
                            Aplicar a este Trabajo
                        </h2>
                        
                        <form method="POST" action="{{ route('applications.store', $job) }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <!-- Carta de Presentación -->
                            <div>
                                <label for="cover_letter" class="block text-sm font-medium text-slate-300 mb-2">
                                    Carta de Presentación
                                    <span class="text-slate-500">(Opcional)</span>
                                </label>
                                <textarea 
                                    name="cover_letter" 
                                    id="cover_letter" 
                                    rows="6" 
                                    class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                    placeholder="Cuéntanos por qué eres el candidato ideal para este puesto..."
                                >{{ old('cover_letter') }}</textarea>
                                @error('cover_letter')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Subida de CV -->
                            <div>
                                <label for="cv_file" class="block text-sm font-medium text-slate-300 mb-2">
                                    Currículum Vitae
                                    <span class="text-slate-500">(PDF, DOC, DOCX - Máx. 5MB)</span>
                                </label>
                                <div class="relative">
                                    <input 
                                        type="file" 
                                        name="cv_file" 
                                        id="cv_file" 
                                        accept=".pdf,.doc,.docx"
                                        class="w-full bg-slate-700/50 border border-slate-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:cursor-pointer"
                                    >
                                </div>
                                @error('cv_file')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Información Adicional -->
                            <div class="bg-slate-700/30 rounded-lg p-4 border border-slate-600/30">
                                <h3 class="font-medium text-white mb-2">Antes de aplicar, asegúrate de:</h3>
                                <ul class="text-slate-300 text-sm space-y-1">
                                    <li><i class="fas fa-check text-emerald-400 mr-2"></i>Haber leído completamente la descripción del trabajo</li>
                                    <li><i class="fas fa-check text-emerald-400 mr-2"></i>Cumplir con los requisitos mínimos</li>
                                    <li><i class="fas fa-check text-emerald-400 mr-2"></i>Tener tu CV actualizado</li>
                                </ul>
                            </div>
                            
                            <!-- Botón de Envío -->
                            <button 
                                type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-4 px-6 rounded-lg font-medium transition-all transform hover:scale-105 text-lg"
                            >
                                <i class="fas fa-paper-plane mr-2"></i>
                                Enviar Aplicación
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Información de la Empresa -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Sobre la Empresa</h3>
                <div class="flex items-center space-x-4 mb-4">
                    <x-employer-logo :employer="$job->employer" :width="48" />
                    <div>
                        <h4 class="font-semibold text-white">{{ $job->employer->name }}</h4>
                        <p class="text-slate-400 text-sm">{{ $job->employer->website ?? 'Empresa verificada' }}</p>
                    </div>
                </div>
                @if($job->employer->description)
                    <p class="text-slate-300 text-sm">{{ $job->employer->description }}</p>
                @endif
            </div>

            <!-- Detalles del Trabajo -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Detalles</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Tipo:</span>
                        <span class="text-white font-medium">{{ ucfirst($job->schedule) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Experiencia:</span>
                        <span class="text-white font-medium">{{ ucfirst($job->experience_level ?? 'No especificado') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Educación:</span>
                        <span class="text-white font-medium">{{ ucfirst($job->education ?? 'No especificado') }}</span>
                    </div>
                    @if($job->duration)
                        <div class="flex justify-between">
                            <span class="text-slate-400">Duración:</span>
                            <span class="text-white font-medium">{{ $job->duration }} meses</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-slate-400">Aplicaciones:</span>
                        <span class="text-white font-medium">{{ $job->applications->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Trabajos Relacionados -->
            @if($relatedJobs->count() > 0)
                <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                    <h3 class="text-lg font-bold text-white mb-4">Trabajos Relacionados</h3>
                    <div class="space-y-4">
                        @foreach($relatedJobs as $relatedJob)
                            <div class="p-4 bg-slate-700/30 rounded-lg border border-slate-600/30 hover:border-slate-500/50 transition-colors">
                                <h4 class="font-medium text-white text-sm mb-1">
                                    <a href="{{ route('jobs.show', $relatedJob) }}" class="hover:text-blue-400">
                                        {{ $relatedJob->title }}
                                    </a>
                                </h4>
                                <p class="text-slate-400 text-xs">{{ $relatedJob->employer->name }}</p>
                                <p class="text-slate-500 text-xs">€{{ number_format($relatedJob->salary_min) }} - €{{ number_format($relatedJob->salary_max) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</x-layout>