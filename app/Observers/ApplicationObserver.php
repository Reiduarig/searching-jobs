<?php

namespace App\Observers;

use App\Models\Application;
use App\Mail\ApplicationStatusChanged;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ApplicationObserver
{
    /**
     * Handle the Application "created" event.
     */
    public function created(Application $application): void
    {
        //
    }

    /**
     * Handle the Application "updated" event.
     */
    public function updated(Application $application): void
    {
        // Verificar si cambió el estado
        if ($application->isDirty('status')) {
            $oldStatus = $application->getOriginal('status');
            $newStatus = $application->status;
            
            // Solo enviar notificación si realmente cambió el estado y no es la primera vez (no es 'pending')
            if ($oldStatus && $oldStatus !== $newStatus) {
                try {
                    Mail::to($application->user->email)
                        ->send(new ApplicationStatusChanged($application, $oldStatus));
                } catch (\Exception $e) {
                    Log::error('Error enviando email de cambio de estado: ' . $e->getMessage());
                }
            }
        }
    }

    /**
     * Handle the Application "deleted" event.
     */
    public function deleted(Application $application): void
    {
        //
    }

    /**
     * Handle the Application "restored" event.
     */
    public function restored(Application $application): void
    {
        //
    }

    /**
     * Handle the Application "force deleted" event.
     */
    public function forceDeleted(Application $application): void
    {
        //
    }
}
