@props([
    'job'
])

<x-panel class="flex flex-col gap-y-6 md:flex-row md:gap-x-6">
    <div>
        <x-employer-logo :employer="$job->employer" />
    </div>
    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-600">{{ $job->employer->name }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800 transition-colors duration-300">
            <a href="{{ $job->url }}" target="_blank" rel="noopener noreferrer">
                {{ $job->title }}
            </a>
        </h3>

        <p class="text-sm text-gray-400 mt-auto">From {{ $job->salary }} €</p>
    </div>

    <div class="space-x-1 mt-auto">  
        @foreach ($job->tags as $tag)
            <x-tag :tag="$tag" />     
        @endforeach
    </div>
</x-panel>