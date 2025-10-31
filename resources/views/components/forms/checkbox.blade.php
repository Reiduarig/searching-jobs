@props([
    'label',
    'name',
    'value' => '1',
    'description' => null,
    'variant' => 'default'
])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
        'value' => $value,
        'class' => 'rounded border-slate-600 text-blue-600 focus:ring-blue-500',
    ];

    $containerClasses = [
        'default' => 'flex items-center space-x-3',
        'card' => 'flex items-center p-3 bg-slate-700/20 rounded-xl hover:bg-slate-700/30 transition-colors cursor-pointer',
        'feature' => 'flex items-start space-x-3 p-4 bg-gradient-to-r from-yellow-500/10 to-orange-500/10 rounded-xl border border-yellow-500/20 cursor-pointer',
    ];
    
    $containerClass = $containerClasses[$variant] ?? $containerClasses['default'];
@endphp

<div>
    <label class="{{ $containerClass }}">
        <input {{ $attributes($defaults) }} />
        <div class="flex-1">
            <span class="text-slate-300 text-sm font-medium">{{ $label }}</span>
            @if($description)
                <p class="text-slate-500 text-xs mt-1">{{ $description }}</p>
            @endif
        </div>
    </label>
</div>