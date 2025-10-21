<x-layout>
    <x-page-heading>
        Resultados de búsqueda para: "{{ $query }}"
    </x-page-heading>

    <div class="space-y-4">
        @forelse ($results as $job)
            <x-job-card-wide :job="$job" />
        @empty
            <p class="text-gray-400">No se encontraron trabajos que coincidan con tu búsqueda.</p>
        @endforelse
    </div>
</x-layout>