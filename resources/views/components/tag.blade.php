@props([
    'size' => 'base'
])

@php
    $classes = 'bg-white/10 hover:bg-white/25 rounded-xl font-bold transition-colors duration-300';
    
    match ($size) {
        'base' => $classes .= ' px-5 py-1 text-sm',
        'small' => $classes .= ' px-2 py-1 text-2xs',
    }
    
@endphp

<a 
    href="#" 
    class="{{ $classes }}"
>
    {{ $slot }}
</a>
