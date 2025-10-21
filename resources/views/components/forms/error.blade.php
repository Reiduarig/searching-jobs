@props([
    'field',
])

@error($field)
    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
@enderror