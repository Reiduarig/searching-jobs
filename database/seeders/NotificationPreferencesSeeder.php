<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationPreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Actualizar usuarios existentes que no tienen preferencias configuradas
        User::whereNull('notification_preferences')->update([
            'notification_preferences' => [
                'new_applications' => true,
                'status_changes' => true,
                'job_recommendations' => true,
                'marketing' => false,
            ]
        ]);

        $this->command->info('Preferencias de notificación actualizadas para todos los usuarios.');
    }
}
