<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">Encuentra el trabajo de tus sueños</h1>
            <form action="#" class="mt-6">
                <input 
                    type="text" 
                    placeholder="¿Qué trabajo estás buscando?" 
                    class="w-full max-w-xl bg-white/5 placeholder-gray-400 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:bg-white/10 transition"
                >
                <button 
                    type="submit" 
                    class="bg-blue-800 hover:bg-blue-900 text-white font-bold rounded-xl px-5 py-3 transition"
                >
                    Buscar
                </button>
            </form>
        </section>
        <section class="pt-10">
            <x-section-heading>Destacados</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                <x-job-card />
                <x-job-card />
                <x-job-card />
            </div>
        </section>

        <section>
            <x-section-heading>Tags</x-section-heading>
            
            <div class="mt-6 space-x-1">
                <x-tag>Tag 1</x-tag>
                <x-tag>Tag 2</x-tag>
                <x-tag>Tag 3</x-tag>
                <x-tag>Tag 4</x-tag>
                <x-tag>Tag 5</x-tag>
                <x-tag>Tag 6</x-tag>
                <x-tag>Tag 7</x-tag>
                <x-tag>Tag 8</x-tag>
                <x-tag>Tag 9</x-tag>
                <x-tag>Tag 10</x-tag>
            </div>
        </section>

        <section>
            <x-section-heading>Recientes</x-section-heading>

            <div class="mt-6 space-y-4">
                <x-job-card-wide />
                <x-job-card-wide />
                <x-job-card-wide />
            </div>
        
        </section>
    </div>
</x-layout>
