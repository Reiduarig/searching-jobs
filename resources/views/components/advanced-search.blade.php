@props(['tags', 'locations', 'salaryRanges'])

<div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50 mb-8">
    <form action="/jobs" method="GET" class="space-y-6">
        <!-- Barra de búsqueda principal -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Título del trabajo, empresa, habilidades..."
                class="w-full pl-12 pr-4 py-3 bg-slate-700/30 border border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
            >
        </div>

        <!-- Filtros en grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Ubicación -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Ubicación</label>
                <select name="location" class="w-full bg-slate-700/30 border border-slate-600/50 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-3 py-2">
                    <option value="">Todas las ubicaciones</option>
                    <option value="remoto" {{ request('location') === 'remoto' ? 'selected' : '' }}>Remoto</option>
                    <option value="madrid" {{ request('location') === 'madrid' ? 'selected' : '' }}>Madrid</option>
                    <option value="barcelona" {{ request('location') === 'barcelona' ? 'selected' : '' }}>Barcelona</option>
                    <option value="valencia" {{ request('location') === 'valencia' ? 'selected' : '' }}>Valencia</option>
                </select>
            </div>

            <!-- Tipo de contrato -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Tipo de contrato</label>
                <select name="schedule" class="w-full bg-slate-700/30 border border-slate-600/50 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-3 py-2">
                    <option value="">Todos los tipos</option>
                    <option value="full-time" {{ request('schedule') === 'full-time' ? 'selected' : '' }}>Tiempo completo</option>
                    <option value="part-time" {{ request('schedule') === 'part-time' ? 'selected' : '' }}>Medio tiempo</option>
                    <option value="contract" {{ request('schedule') === 'contract' ? 'selected' : '' }}>Por contrato</option>
                </select>
            </div>

            <!-- Rango salarial -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Salario</label>
                <select name="salary_range" class="w-full bg-slate-700/30 border border-slate-600/50 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-3 py-2">
                    <option value="">Cualquier salario</option>
                    <option value="30000-50000" {{ request('salary_range') === '30000-50000' ? 'selected' : '' }}>€30k - €50k</option>
                    <option value="50000-70000" {{ request('salary_range') === '50000-70000' ? 'selected' : '' }}>€50k - €70k</option>
                    <option value="70000-100000" {{ request('salary_range') === '70000-100000' ? 'selected' : '' }}>€70k - €100k</option>
                    <option value="100000+" {{ request('salary_range') === '100000+' ? 'selected' : '' }}>€100k+</option>
                </select>
            </div>

            <!-- Experiencia -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Experiencia</label>
                <select name="experience" class="w-full bg-slate-700/30 border border-slate-600/50 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-3 py-2">
                    <option value="">Cualquier nivel</option>
                    <option value="junior" {{ request('experience') === 'junior' ? 'selected' : '' }}>Junior (0-2 años)</option>
                    <option value="mid" {{ request('experience') === 'mid' ? 'selected' : '' }}>Mid (2-5 años)</option>
                    <option value="senior" {{ request('experience') === 'senior' ? 'selected' : '' }}>Senior (5+ años)</option>
                </select>
            </div>
        </div>

        <!-- Tags/Habilidades -->
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Tecnologías</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="inline-flex items-center">
                        <input 
                            type="checkbox" 
                            name="tags[]" 
                            value="{{ $tag->id }}"
                            {{ in_array($tag->id, request('tags', [])) ? 'checked' : '' }}
                            class="sr-only"
                        >
                        <span class="px-3 py-1 rounded-full text-sm font-medium cursor-pointer transition-all
                            {{ in_array($tag->id, request('tags', [])) 
                                ? 'bg-blue-600 text-white' 
                                : 'bg-slate-700/30 text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            {{ $tag->name }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex flex-col sm:flex-row gap-3">
            <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg">
                🔍 Buscar Trabajos
            </button>
            <a href="/jobs" class="flex-1 sm:flex-none bg-slate-700/30 hover:bg-slate-700/50 border border-slate-600/50 text-slate-300 hover:text-white font-medium px-6 py-3 rounded-xl transition-all text-center">
                Limpiar Filtros
            </a>
            <button type="button" id="save-search" class="flex-1 sm:flex-none bg-green-600/20 hover:bg-green-600/30 border border-green-500/30 text-green-400 hover:text-green-300 font-medium px-6 py-3 rounded-xl transition-all">
                💾 Guardar Búsqueda
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar checkboxes de tags
    const tagCheckboxes = document.querySelectorAll('input[name="tags[]"]');
    tagCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const span = this.nextElementSibling;
            if (this.checked) {
                span.classList.remove('bg-slate-700/30', 'text-slate-300');
                span.classList.add('bg-blue-600', 'text-white');
            } else {
                span.classList.remove('bg-blue-600', 'text-white');
                span.classList.add('bg-slate-700/30', 'text-slate-300');
            }
        });
    });

    // Guardar búsqueda
    document.getElementById('save-search').addEventListener('click', function() {
        // Implementar funcionalidad de guardar búsqueda
        alert('Funcionalidad de guardar búsqueda próximamente...');
    });
});
</script>