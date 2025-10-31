@props([
    'employer',
    'width' => 90,
    'useSkeleton' => false
])

@php
    // Determinar si usar skeleton
    $shouldUseSkeleton = $useSkeleton || 
                        !$employer || 
                        !$employer->name || 
                        strlen(trim($employer->name)) < 2;
    
    if (!$shouldUseSkeleton) {
        // Generar un color consistente basado en el hash del nombre
        $hash = md5($employer->name);
        
        // Definir diferentes estilos de gradiente
        $gradients = [
            'bg-gradient-to-br from-blue-500 to-purple-600',
            'bg-gradient-to-br from-emerald-500 to-teal-600', 
            'bg-gradient-to-br from-orange-500 to-red-600',
            'bg-gradient-to-br from-pink-500 to-rose-600',
            'bg-gradient-to-br from-indigo-500 to-blue-600',
            'bg-gradient-to-br from-green-500 to-emerald-600',
            'bg-gradient-to-br from-yellow-500 to-orange-600',
            'bg-gradient-to-br from-purple-500 to-indigo-600',
            'bg-gradient-to-br from-teal-500 to-cyan-600',
            'bg-gradient-to-br from-red-500 to-pink-600'
        ];
        
        // Seleccionar gradiente basado en el hash
        $gradientIndex = hexdec(substr($hash, 2, 1)) % count($gradients);
        $gradientClass = $gradients[$gradientIndex];
        
        // Obtener iniciales
        $cleanName = preg_replace('/[^a-zA-Z\s]/', '', $employer->name);
        $words = array_filter(explode(' ', $cleanName));
        
        if (count($words) >= 2) {
            $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        } else {
            $initials = strtoupper(substr($cleanName, 0, 2));
        }
        
        // Si las iniciales están vacías, usar skeleton
        if (empty($initials)) {
            $shouldUseSkeleton = true;
        }
    }
@endphp

@if($employer && $employer->logo_url && !$shouldUseSkeleton)
    <!-- Logo real -->
    <div class="relative group">
        <img 
            src="{{ Storage::url($employer->logo_url) }}" 
            alt="{{ $employer->name }} logo" 
            class="rounded-xl shadow-lg transition-transform duration-200 group-hover:scale-105 object-cover"
            style="width: {{ $width }}px; height: {{ $width }}px;">
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
    </div>
@elseif($shouldUseSkeleton)
    <!-- Skeleton/placeholder -->
    <div 
        class="relative rounded-xl overflow-hidden bg-gradient-to-br from-slate-700/40 to-slate-600/40 border border-slate-600/30 flex items-center justify-center"
        style="width: {{ $width }}px; height: {{ $width }}px;">
        
        <svg class="text-slate-400" style="width: {{ $width * 0.4 }}px; height: {{ $width * 0.4 }}px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        
        <div class="absolute top-1 left-1 w-2 h-2 bg-white/20 rounded-full"></div>
    </div>
@else
    <!-- Avatar generado con iniciales -->
    <div 
        class="relative {{ $gradientClass }} rounded-xl flex items-center justify-center text-white font-bold shadow-lg transition-all duration-200 hover:scale-105 hover:shadow-xl overflow-hidden"
        style="width: {{ $width }}px; height: {{ $width }}px;">
        
        <!-- Patrón de fondo -->
        <div class="absolute inset-0 bg-white/15 rounded-xl"></div>
        <div class="absolute inset-0 bg-gradient-to-tr from-white/10 via-transparent to-black/10 rounded-xl"></div>
        
        <!-- Efectos de luz más visibles -->
        <div class="absolute top-2 left-2 w-4 h-4 bg-white/50 rounded-full blur-sm"></div>
        <div class="absolute bottom-1 right-1 w-3 h-3 bg-black/30 rounded-full"></div>
        
        <!-- Iniciales con tamaño adaptativo y mejor contraste -->
        <span class="relative z-10 font-bold tracking-wider text-white drop-shadow-lg" 
              style="font-size: {{ $width < 48 ? '14px' : ($width < 64 ? '16px' : ($width < 80 ? '18px' : '24px')) }};">
            {{ $initials }}
        </span>
        
        <!-- Efecto hover -->
        <div class="absolute inset-0 bg-white/0 hover:bg-white/5 rounded-xl transition-colors duration-200"></div>
    </div>
@endif