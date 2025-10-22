@php 
  $classes = 'p-6 bg-slate-800/40 backdrop-blur-sm rounded-2xl border border-slate-700/50 hover:border-blue-500/50 hover:bg-slate-800/60 group transition-all duration-300 shadow-lg hover:shadow-xl hover:shadow-blue-500/10 hover:-translate-y-1';
@endphp

<div {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</div>