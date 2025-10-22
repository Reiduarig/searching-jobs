@props([
    'employer',
    'width' => 90
])
@if($employer->logo_url)
    <img 
        src="{{ asset($employer->logo_url) }}" 
        alt="{{ $employer->name }} logo" 
        width="{{ $width }}" 
        class="rounded-xl">

@else
    <div 
        class="w-{{ $width }} h-{{ $width }} bg-slate-700/50 rounded-xl flex items-center justify-center text-slate-400 font-bold text-xl"
        style="width: {{ $width }}px; height: {{ $width }}px;">
        {{ strtoupper(substr($employer->name, 0, 2)) }}
    </div>
@endif