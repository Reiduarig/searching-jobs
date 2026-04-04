<div class="max-w-2xl mx-auto">
    <x-forms.form action="/search" class="relative">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <x-forms.input 
                name="q" 
                placeholder="Ej: Desarrollador Full Stack, Diseñador UX/UI, Project Manager..." 
                :label="false"
                class="w-full pl-12 pr-32 py-4 bg-slate-800/60 backdrop-blur-sm border border-slate-700/50 placeholder-slate-400 rounded-2xl text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-slate-800/80 transition-all duration-300"
            />
            <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg">
                    Buscar
                </button>
            </div>
        </div>
    </x-forms.form>
</div>