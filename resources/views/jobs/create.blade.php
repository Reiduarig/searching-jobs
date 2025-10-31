@extends('components.layout')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-blue-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-white">Crear Nueva Oferta</h1>
                <p class="text-slate-400">Completa la información para publicar tu oferta de trabajo</p>
            </div>
        </div>
    </div>

    <!-- Formulario Principal -->
    <x-forms.form method="POST" action="{{ route('jobs.store') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Contenido Principal -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Información Básica -->
            <x-forms.section title="Información Básica">
                <x-forms.input 
                    name="title" 
                    label="Título del Puesto" 
                    placeholder="ej. Senior Frontend Developer"
                    description="Un título claro y descriptivo ayuda a atraer mejores candidatos"
                    required />

                <x-forms.textarea 
                    name="description" 
                    label="Descripción del Trabajo" 
                    rows="6"
                    placeholder="Describe las responsabilidades, requisitos y lo que hace especial este trabajo..."
                    description="Mínimo 100 caracteres. Sé específico sobre las responsabilidades y beneficios."
                    required />

                <x-forms.grid columns="2">
                    <x-forms.input 
                        name="location" 
                        label="Ubicación" 
                        placeholder="Madrid, Barcelona, Remoto..."
                        required />

                    <x-forms.select 
                        name="schedule" 
                        label="Modalidad de Trabajo" 
                        required>
                        <option value="">Selecciona una modalidad</option>
                        <option value="full-time">Tiempo Completo</option>
                        <option value="part-time">Tiempo Parcial</option>
                        <option value="contract">Por Contrato</option>
                        <option value="freelance">Freelance</option>
                        <option value="internship">Prácticas</option>
                    </x-forms.select>
                </x-forms.grid>

                <x-forms.grid columns="3">
                    <x-forms.input 
                        name="salary_min" 
                        label="Salario Mínimo (€)" 
                        type="number"
                        placeholder="30000"
                        min="0"
                        step="1000"
                        required />

                    <x-forms.input 
                        name="salary_max" 
                        label="Salario Máximo (€)" 
                        type="number"
                        placeholder="50000"
                        min="0"
                        step="1000" />

                    <x-forms.select 
                        name="salary_period" 
                        label="Período">
                        <option value="yearly">Anual</option>
                        <option value="monthly">Mensual</option>
                        <option value="hourly">Por Hora</option>
                    </x-forms.select>
                </x-forms.grid>

                <x-forms.input 
                    name="url" 
                    label="URL de Aplicación" 
                    type="url"
                    placeholder="https://empresa.com/careers/apply"
                    description="Los candidatos serán redirigidos a esta URL para aplicar"
                    required />
            </x-forms.section>

            <!-- Requisitos y Habilidades -->
            <x-forms.section title="Requisitos y Habilidades">
                <x-forms.select 
                    name="experience_level" 
                    label="Nivel de Experiencia">
                    <option value="">Selecciona el nivel</option>
                    <option value="entry">Entrada / Junior (0-2 años)</option>
                    <option value="mid">Intermedio (2-5 años)</option>
                    <option value="senior">Senior (5+ años)</option>
                    <option value="lead">Lead / Arquitecto (8+ años)</option>
                </x-forms.select>

                <div>
                    <x-forms.input 
                        name="tags" 
                        label="Tecnologías y Habilidades" 
                        placeholder="React, JavaScript, Node.js, AWS, Docker"
                        description="Separa las habilidades con comas. Máximo 10 habilidades."
                        required />
                    
                    <!-- Sugerencias de Tags -->
                    <div class="mt-3">
                        <p class="text-xs text-slate-400 mb-2">Sugerencias populares:</p>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="addTag('JavaScript')" class="px-3 py-1 bg-slate-600/50 hover:bg-slate-600 text-slate-300 hover:text-white text-xs rounded-full transition-colors">JavaScript</button>
                            <button type="button" onclick="addTag('React')" class="px-3 py-1 bg-slate-600/50 hover:bg-slate-600 text-slate-300 hover:text-white text-xs rounded-full transition-colors">React</button>
                            <button type="button" onclick="addTag('Node.js')" class="px-3 py-1 bg-slate-600/50 hover:bg-slate-600 text-slate-300 hover:text-white text-xs rounded-full transition-colors">Node.js</button>
                            <button type="button" onclick="addTag('Python')" class="px-3 py-1 bg-slate-600/50 hover:bg-slate-600 text-slate-300 hover:text-white text-xs rounded-full transition-colors">Python</button>
                            <button type="button" onclick="addTag('Laravel')" class="px-3 py-1 bg-slate-600/50 hover:bg-slate-600 text-slate-300 hover:text-white text-xs rounded-full transition-colors">Laravel</button>
                            <button type="button" onclick="addTag('Vue.js')" class="px-3 py-1 bg-slate-600/50 hover:bg-slate-600 text-slate-300 hover:text-white text-xs rounded-full transition-colors">Vue.js</button>
                            <button type="button" onclick="addTag('AWS')" class="px-3 py-1 bg-slate-600/50 hover:bg-slate-600 text-slate-300 hover:text-white text-xs rounded-full transition-colors">AWS</button>
                            <button type="button" onclick="addTag('Docker')" class="px-3 py-1 bg-slate-600/50 hover:bg-slate-600 text-slate-300 hover:text-white text-xs rounded-full transition-colors">Docker</button>
                        </div>
                    </div>
                </div>

                <x-forms.select 
                    name="education" 
                    label="Educación Requerida">
                    <option value="">Sin requisitos específicos</option>
                    <option value="high-school">Bachillerato</option>
                    <option value="associate">Grado Superior / FP</option>
                    <option value="bachelor">Licenciatura / Grado</option>
                    <option value="master">Máster</option>
                    <option value="phd">Doctorado</option>
                </x-forms.select>
            </x-forms.section>

            <!-- Beneficios -->
            <x-forms.section title="Beneficios y Ventajas">
                <x-forms.grid columns="2">
                    <x-forms.checkbox 
                        name="benefits[]" 
                        value="health-insurance"
                        label="Seguro médico"
                        variant="card" />
                    
                    <x-forms.checkbox 
                        name="benefits[]" 
                        value="remote-work"
                        label="Trabajo remoto"
                        variant="card" />
                    
                    <x-forms.checkbox 
                        name="benefits[]" 
                        value="flexible-hours"
                        label="Horario flexible"
                        variant="card" />
                    
                    <x-forms.checkbox 
                        name="benefits[]" 
                        value="training"
                        label="Formación continua"
                        variant="card" />
                    
                    <x-forms.checkbox 
                        name="benefits[]" 
                        value="bonus"
                        label="Bonos por rendimiento"
                        variant="card" />
                    
                    <x-forms.checkbox 
                        name="benefits[]" 
                        value="vacation"
                        label="Vacaciones adicionales"
                        variant="card" />
                </x-forms.grid>
            </x-forms.section>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Vista Previa -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Vista Previa</h3>
                <div class="space-y-4">
                    <div class="p-4 bg-slate-700/30 rounded-xl border border-slate-600/30">
                        <h4 id="preview-title" class="font-semibold text-white mb-2">Título del trabajo</h4>
                        <div class="flex items-center space-x-4 text-sm text-slate-400 mb-3">
                            <span id="preview-location">Ubicación</span>
                            <span id="preview-schedule">Modalidad</span>
                        </div>
                        <div class="text-slate-300 text-sm mb-3">
                            <span id="preview-salary">Salario no especificado</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-slate-600/50 text-slate-300 text-xs rounded-full">Vista previa</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuración de Publicación -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Configuración</h3>
                <div class="space-y-4">
                    <!-- Destacar Oferta -->
                    <x-forms.checkbox 
                        name="featured"
                        label="Destacar oferta"
                        description="Aparecerá en la parte superior y con un badge especial. +€50"
                        variant="feature" />

                    <!-- Urgente -->
                    <label class="flex items-start space-x-3 p-4 bg-gradient-to-r from-red-500/10 to-pink-500/10 rounded-xl border border-red-500/20 cursor-pointer">
                        <input type="checkbox" name="urgent" class="mt-1 rounded border-slate-600 text-red-600 focus:ring-red-500">
                        <div>
                            <span class="text-red-400 font-medium text-sm">Marcas como urgente</span>
                            <p class="text-red-500/80 text-xs mt-1">Badge de urgencia y mayor visibilidad. +€25</p>
                        </div>
                    </label>

                    <!-- Duración -->
                    <x-forms.select 
                        name="duration" 
                        label="Duración de la publicación">
                        <option value="30">30 días (Gratis)</option>
                        <option value="60">60 días (+€20)</option>
                        <option value="90">90 días (+€35)</option>
                    </x-forms.select>
                </div>
            </div>

            <!-- Resumen de Costos -->
            <div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
                <h3 class="text-lg font-bold text-white mb-4">Resumen</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-300">Publicación básica</span>
                        <span class="text-emerald-400">Gratis</span>
                    </div>
                    <div id="cost-featured" class="items-center justify-between text-sm hidden">
                        <span class="text-slate-300">Destacar oferta</span>
                        <span class="text-yellow-400">€50</span>
                    </div>
                    <div id="cost-urgent" class="items-center justify-between text-sm hidden">
                        <span class="text-slate-300">Urgente</span>
                        <span class="text-red-400">€25</span>
                    </div>
                    <div id="cost-duration" class="items-center justify-between text-sm hidden">
                        <span class="text-slate-300">Duración extendida</span>
                        <span class="text-blue-400" id="duration-cost">€20</span>
                    </div>
                    <div class="border-t border-slate-700 pt-3">
                        <div class="flex items-center justify-between font-semibold">
                            <span class="text-white">Total</span>
                            <span id="total-cost" class="text-emerald-400">Gratis</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="space-y-3">
                <x-forms.button type="submit" class="w-full">
                    Publicar Oferta de Trabajo
                </x-forms.button>
                <x-forms.button type="button" variant="secondary" class="w-full">
                    Guardar como Borrador
                </x-forms.button>
            </div>
        </div>
    </x-forms.form>
</div>

<script>
function addTag(tag) {
    const tagsInput = document.getElementById('tags');
    const currentTags = tagsInput.value;
    
    if (currentTags === '') {
        tagsInput.value = tag;
    } else if (!currentTags.includes(tag)) {
        tagsInput.value = currentTags + ', ' + tag;
    }
    
    updatePreview();
}

function updatePreview() {
    const title = document.getElementById('title').value || 'Título del trabajo';
    const location = document.getElementById('location').value || 'Ubicación';
    const schedule = document.getElementById('schedule').value || 'Modalidad';
    const salaryMin = document.getElementById('salary_min').value;
    const salaryMax = document.getElementById('salary_max').value;
    const period = document.getElementById('salary_period').value;
    
    document.getElementById('preview-title').textContent = title;
    document.getElementById('preview-location').textContent = location;
    document.getElementById('preview-schedule').textContent = schedule;
    
    let salaryText = 'Salario no especificado';
    if (salaryMin) {
        salaryText = `€${parseInt(salaryMin).toLocaleString()}`;
        if (salaryMax) {
            salaryText += ` - €${parseInt(salaryMax).toLocaleString()}`;
        }
        if (period === 'monthly') salaryText += '/mes';
        else if (period === 'hourly') salaryText += '/hora';
        else salaryText += '/año';
    }
    
    document.getElementById('preview-salary').textContent = salaryText;
}

function updateCosts() {
    const featured = document.querySelector('input[name="featured"]').checked;
    const urgent = document.querySelector('input[name="urgent"]').checked;
    const duration = document.getElementById('duration').value;
    
    let total = 0;
    
    // Featured cost
    const featuredCost = document.getElementById('cost-featured');
    if (featured) {
        featuredCost.classList.remove('hidden');
        featuredCost.classList.add('flex');
        total += 50;
    } else {
        featuredCost.classList.add('hidden');
        featuredCost.classList.remove('flex');
    }
    
    // Urgent cost
    const urgentCost = document.getElementById('cost-urgent');
    if (urgent) {
        urgentCost.classList.remove('hidden');
        urgentCost.classList.add('flex');
        total += 25;
    } else {
        urgentCost.classList.add('hidden');
        urgentCost.classList.remove('flex');
    }
    
    // Duration cost
    const durationCost = document.getElementById('cost-duration');
    const durationCostText = document.getElementById('duration-cost');
    if (duration === '60') {
        durationCost.classList.remove('hidden');
        durationCost.classList.add('flex');
        durationCostText.textContent = '€20';
        total += 20;
    } else if (duration === '90') {
        durationCost.classList.remove('hidden');
        durationCost.classList.add('flex');
        durationCostText.textContent = '€35';
        total += 35;
    } else {
        durationCost.classList.add('hidden');
        durationCost.classList.remove('flex');
    }
    
    // Update total
    const totalElement = document.getElementById('total-cost');
    if (total === 0) {
        totalElement.textContent = 'Gratis';
        totalElement.className = 'text-emerald-400';
    } else {
        totalElement.textContent = `€${total}`;
        totalElement.className = 'text-blue-400';
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Preview updates
    document.getElementById('title').addEventListener('input', updatePreview);
    document.getElementById('location').addEventListener('input', updatePreview);
    document.getElementById('schedule').addEventListener('change', updatePreview);
    document.getElementById('salary_min').addEventListener('input', updatePreview);
    document.getElementById('salary_max').addEventListener('input', updatePreview);
    document.getElementById('salary_period').addEventListener('change', updatePreview);
    
    // Cost updates
    document.querySelector('input[name="featured"]').addEventListener('change', updateCosts);
    document.querySelector('input[name="urgent"]').addEventListener('change', updateCosts);
    document.getElementById('duration').addEventListener('change', updateCosts);
    
    // Initial updates
    updatePreview();
    updateCosts();
});
</script>
@endsection