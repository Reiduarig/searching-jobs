@extends('emails.layout')

@section('title', 'Actualización de tu aplicación')

@section('header-title', 'Actualización de Aplicación')

@section('header-subtitle', 'Hay novedades sobre tu aplicación de trabajo')

@section('content')
    <h2 style="color: #1a202c; margin: 0 0 20px 0;">Hola {{ $application->user->name }},</h2>
    
    <p style="margin: 0 0 20px 0; color: #4a5568; font-size: 16px;">
        Tenemos una actualización sobre tu aplicación. El estado de tu solicitud ha cambiado.
    </p>
    
    <div class="job-card">
        <h3 class="job-title">{{ $application->job->title }}</h3>
        <p class="company-name">{{ $application->job->employer->name }}</p>
        
        <div class="job-details">
            <span class="detail-item">📍 {{ $application->job->location ?? 'Remoto' }}</span>
            <span class="detail-item">📅 Aplicado {{ $application->applied_at->format('d/m/Y') }}</span>
            @if($application->job->salary_min && $application->job->salary_max)
                <span class="detail-item">💰 €{{ number_format($application->job->salary_min) }} - €{{ number_format($application->job->salary_max) }}</span>
            @endif
        </div>
        
        <div class="divider"></div>
        
        <div style="text-align: center; margin: 20px 0;">
            <h4 style="color: #1a202c; margin: 0 0 16px 0;">Estado de tu Aplicación:</h4>
            
            <div style="display: flex; justify-content: center; align-items: center; gap: 16px; margin: 20px 0;">
                <div style="text-align: center;">
                    <p style="margin: 0 0 8px 0; font-size: 14px; color: #64748b;">Estado Anterior</p>
                    <span class="status-badge status-{{ $oldStatus }}">
                        {{ ucfirst(str_replace('_', ' ', $oldStatus)) }}
                    </span>
                </div>
                
                <div style="font-size: 24px; color: #3b82f6;">→</div>
                
                <div style="text-align: center;">
                    <p style="margin: 0 0 8px 0; font-size: 14px; color: #64748b;">Estado Actual</p>
                    <span class="status-badge status-{{ $application->status }}">
                        {{ $application->status_label }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    @if($application->status === 'accepted')
        <div style="background: #d1fae5; border: 1px solid #10b981; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center;">
            <h3 style="color: #065f46; margin: 0 0 12px 0;">🎉 ¡Felicitaciones!</h3>
            <p style="margin: 0; color: #064e3b; font-size: 16px;">
                Tu aplicación ha sido <strong>aceptada</strong>. El empleador se pondrá en contacto contigo pronto para los siguientes pasos.
            </p>
        </div>
    @elseif($application->status === 'interviewed')
        <div style="background: #e0e7ff; border: 1px solid #8b5cf6; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center;">
            <h3 style="color: #5b21b6; margin: 0 0 12px 0;">📞 ¡Siguiente Paso!</h3>
            <p style="margin: 0; color: #4c1d95; font-size: 16px;">
                Has sido <strong>seleccionado para una entrevista</strong>. El empleador te contactará pronto con los detalles.
            </p>
        </div>
    @elseif($application->status === 'reviewed')
        <div style="background: #dbeafe; border: 1px solid #3b82f6; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center;">
            <h3 style="color: #1e40af; margin: 0 0 12px 0;">👀 En Proceso</h3>
            <p style="margin: 0; color: #1e3a8a; font-size: 16px;">
                Tu aplicación está siendo <strong>revisada</strong> por el equipo de reclutamiento.
            </p>
        </div>
    @elseif($application->status === 'rejected')
        <div style="background: #fee2e2; border: 1px solid #ef4444; border-radius: 8px; padding: 20px; margin: 20px 0;">
            <h3 style="color: #991b1b; margin: 0 0 12px 0;">Resultado de tu Aplicación</h3>
            <p style="margin: 0 0 12px 0; color: #7f1d1d; font-size: 16px;">
                Aunque tu aplicación no fue seleccionada en esta ocasión, te animamos a seguir aplicando a otras oportunidades.
            </p>
            <p style="margin: 0; color: #7f1d1d; font-size: 14px;">
                <strong>Recuerda:</strong> Cada aplicación es una oportunidad de aprendizaje. ¡Sigue adelante!
            </p>
        </div>
    @endif
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ config('app.url') }}/applications" class="btn">
            Ver Mis Aplicaciones
        </a>
    </div>
    
    @if($application->status !== 'accepted' && $application->status !== 'rejected')
        <div style="background: #f0f9ff; border: 1px solid #0ea5e9; border-radius: 8px; padding: 16px; margin: 20px 0;">
            <p style="margin: 0; color: #0c4a6e; font-size: 14px;">
                <strong>💡 Mantente al día:</strong> Te mantendremos informado sobre cualquier actualización en tu aplicación. Mientras tanto, puedes seguir aplicando a otros trabajos.
            </p>
        </div>
    @endif
    
    <p style="color: #64748b; font-size: 14px; margin: 20px 0 0 0;">
        Puedes ver el estado de todas tus aplicaciones en tu dashboard personal.
    </p>
@endsection