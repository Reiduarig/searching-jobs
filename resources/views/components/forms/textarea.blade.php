@props([
    'label',
    'name',
    'description' => null
])

@php 
    $defaults = [
        'id' => $name,
        'name' => $name,
        'rows' => 4,
        'class' => 'w-full bg-slate-700/30 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all resize-none',
    ];
@endphp

<x-forms.field :label="$label" :name="$name" :description="$description">
    <textarea {{ $attributes($defaults) }}>{{ old($name) }}</textarea>
</x-forms.field>