@props([
    'employer',
    'width' => 90
])

@if(env('APP_ENV') === 'local')
    <img 
        src="https://picsum.photos/seed/{{ rand(1, 10000) }}/{{ $width }}" 
        alt="imagen" 
        class="rounded-xl">
    
@else
    <img 
        src="{{ asset($employer->logo_url) }}" 
        alt="{{ $employer->name }} logo" 
        width="{{ $width }}" 
        class="rounded-xl">

@endif