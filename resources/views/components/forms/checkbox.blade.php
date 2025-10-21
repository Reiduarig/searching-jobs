@props([
    'label',
    'name'
])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
        'value' => old($name),
    ];
@endphp

<x-forms.field :label="$label" :name="$name">
    <input {{ $attributes($defaults) }} />
    <span class="pl-1">{{ $label }}</span>
</x-forms.field>