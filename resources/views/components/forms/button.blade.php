@props([
    'variant' => 'primary'
])

@php
    $classes = [
        'primary' => 'bg-gradient-to-r from-emerald-600 to-blue-600 hover:from-emerald-700 hover:to-blue-700 text-white',
        'secondary' => 'bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white border border-slate-600/50',
        'danger' => 'bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white',
    ];
    
    $baseClasses = 'py-3 px-6 rounded-xl font-medium transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/20';
    $variantClasses = $classes[$variant] ?? $classes['primary'];
@endphp

<button {{ $attributes(['class' => $baseClasses . ' ' . $variantClasses]) }}>
    {{ $slot }}
</button>