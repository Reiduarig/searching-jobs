@props([
    'title',
    'description' => null,
    'benefits' => []
])

<div class="bg-slate-800/40 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/50">
    <h2 class="text-xl font-bold text-white mb-6">{{ $title }}</h2>
    
    @if($description)
        <p class="text-slate-400 mb-6">{{ $description }}</p>
    @endif

    <div class="space-y-6">
        {{ $slot }}
    </div>
</div>