@props(['tags'])

<section class="text-center py-12 relative">
    <!-- Efectos visuales de fondo -->
    <div class="absolute inset-0 flex items-center justify-center opacity-10">
        <div class="w-96 h-96 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative z-10 space-y-8">
        <div class="space-y-4">
            <h1 class="font-bold text-5xl md:text-6xl lg:text-7xl bg-gradient-to-r from-white via-blue-100 to-purple-100 bg-clip-text text-transparent leading-tight">
                Impulsa tu
                <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">carrera profesional</span>
                al siguiente nivel
            </h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                Conectamos el mejor talento con las mejores oportunidades. Tu próximo empleo te está esperando.
            </p>
        </div>
        
        <!-- Barra de búsqueda mejorada -->
        {{-- <x-layout.search /> --}}
        <x-advanced-search :tags="$tags" />

        <!-- Estadísticas -->
        <x-layout.stats />
    </div>
</section>