@props([
    'columns' => 1
])

@php
    $gridClasses = [
        1 => 'grid-cols-1',
        2 => 'grid-cols-1 md:grid-cols-2',
        3 => 'grid-cols-1 md:grid-cols-3',
        4 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4',
    ];
    
    $gridClass = $gridClasses[$columns] ?? $gridClasses[1];
@endphp

<div class="grid {{ $gridClass }} gap-6">
    {{ $slot }}
</div>