@props([
    'name',
    'label'
])

<label for="{{ $name }}" class="block text-sm font-medium text-slate-300">
    {{ $label }}
</label>