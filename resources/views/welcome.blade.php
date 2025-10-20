<x-layout>
    <div class="space-y-10">
        <section>
            <x-section-heading>Destacados</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                <x-job-card />
                <x-job-card />
                <x-job-card />
            </div>
        </section>

        <section>
            <x-section-heading>Tags</x-section-heading>
            
            <div class="mt-6 space-x-1">
                <x-tag>Tag 1</x-tag>
                <x-tag>Tag 2</x-tag>
                <x-tag>Tag 3</x-tag>
                <x-tag>Tag 4</x-tag>
                <x-tag>Tag 5</x-tag>
                <x-tag>Tag 6</x-tag>
                <x-tag>Tag 7</x-tag>
                <x-tag>Tag 8</x-tag>
                <x-tag>Tag 9</x-tag>
                <x-tag>Tag 10</x-tag>
            </div>
        </section>

        <section>
            <x-section-heading>Recientes</x-section-heading>
        </section>
    </div>
</x-layout>
