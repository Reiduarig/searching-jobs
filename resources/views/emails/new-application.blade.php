@extends('emails.layout')

@section('title', 'Nueva aplicación recibida')

@section('header-title', '¡Nueva Aplicación!')

@section('header-subtitle', 'Has recibido una nueva aplicación para tu trabajo')

@section('content')
    <h2 style="color: #1a202c; margin: 0 0 20px 0;">Hola {{ $application->job->employer->user->name }},</h2>
    
    <p style="margin: 0 0 20px 0; color: #4a5568; font-size: 16px;">
        ¡Excelentes noticias! Has recibido una nueva aplicación para tu trabajo publicado en JobSearch.
    </p>
    
    <div class="job-card">
        <h3 class="job-title">{{ $application->job->title }}</h3>
        <p class="company-name">{{ $application->job->employer->name }}</p>
        
        <div class="job-details">
            <span class="detail-item">📍 {{ $application->job->location ?? 'Remoto' }}</span>
            <span class="detail-item">📅 Aplicado {{ $application->applied_at->format('d/m/Y H:i') }}</span>
            @if($application->job->salary_min && $application->job->salary_max)
                <span class="detail-item">💰 €{{ number_format($application->job->salary_min) }} - €{{ number_format($application->job->salary_max) }}</span>
            @endif
        </div>
        
        <div class="divider"></div>
        
        <h4 style="color: #1a202c; margin: 16px 0 8px 0;">Información del Candidato:</h4>
        <p style="margin: 0 0 8px 0;"><strong>Nombre:</strong> {{ $application->user->name }}</p>
        <p style="margin: 0 0 8px 0;"><strong>Email:</strong> {{ $application->user->email }}</p>
        <p style="margin: 0 0 16px 0;"><strong>Estado:</strong> 
            <span class="status-badge status-{{ $application->status }}">{{ $application->status_label }}</span>
        </p>
        
        @if($application->cover_letter)
            <h4 style="color: #1a202c; margin: 16px 0 8px 0;">Carta de Presentación:</h4>
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 16px; margin: 0 0 16px 0;">
                <p style="margin: 0; color: #4a5568; font-style: italic;">
                    "{{ Str::limit($application->cover_letter, 300) }}"
                </p>
            </div>
        @endif
        
        @if($application->cv_path)
            <p style="margin: 16px 0 0 0;">
                <strong>CV adjunto:</strong> 
                <a href="{{ Storage::url($application->cv_path) }}" style="color: #3b82f6;">Descargar CV</a>
            </p>
        @endif
    </div>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ config('app.url') }}/dashboard" class="btn">
            Ver en Dashboard
        </a>
    </div>
    
    <div style="background: #fef3c7; border: 1px solid #f59e0b; border-radius: 8px; padding: 16px; margin: 20px 0;">
        <p style="margin: 0; color: #92400e; font-size: 14px;">
            <strong>💡 Consejo:</strong> Responde rápidamente a las aplicaciones para mantener el interés de los candidatos. Los mejores talentos suelen tener múltiples opciones.
        </p>
    </div>
    
    <p style="color: #64748b; font-size: 14px; margin: 20px 0 0 0;">
        Puedes revisar esta aplicación y gestionar todas tus aplicaciones desde tu dashboard de empleador.
    </p>
@endsection