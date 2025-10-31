@props([
    'label',
    'name',
    'description' => null
])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'w-full bg-slate-700/30 border border-slate-600 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all',
    ];
@endphp

<x-forms.field :label="$label" :name="$name" :description="$description">
    <select {{ $attributes($defaults) }}>
        {{ $slot }}
    </select>
</x-forms.field>