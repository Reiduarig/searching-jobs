@props([
    'label',
    'name',
    'description' => null
])

<div class="space-y-2">
    @if ($label)
        <x-forms.label :name="$name" :label="$label" />
    @endif

    <div>
        {{ $slot }}

        @if ($description)
            <p class="text-slate-500 text-xs mt-1">{{ $description }}</p>
        @endif

        <x-forms.error :field="$name" :error="$errors->first($name)" />
    </div>
</div>