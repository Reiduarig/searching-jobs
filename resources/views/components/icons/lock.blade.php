@props([
    'size' => 'md',
    'color' => 'currentColor',
])

@php
    $sizeClass = match ($size) {
        'sm' => 'h-4 w-4',
        'md' => 'h-6 w-6',
        'lg' => 'h-8 w-8',
        default => 'h-6 w-6',
    };

    $colorClass = match ($color) {
        'primary' => 'text-blue-600',
        'secondary' => 'text-gray-600',
        'success' => 'text-green-600',
        'danger' => 'text-red-600',
        'warning' => 'text-yellow-600',
        'currentColor' => 'currentColor',
        default => 'currentColor',
    };
@endphp

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{ $colorClass }}" class="{{ $sizeClass }}">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
</svg>
