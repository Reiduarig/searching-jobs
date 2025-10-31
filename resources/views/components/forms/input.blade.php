@props([
    'label',
    'name',
    'description' => null
])

@php 
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'value' => old($name),
        'class' => 'w-full bg-slate-700/30 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all',
    ];
@endphp

<x-forms.field :label="$label" :name="$name" :description="$description">
    <input {{ $attributes($defaults) }} />
</x-forms.field>