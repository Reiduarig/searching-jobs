<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationPreferencesController extends Controller
{
    public function show(): View
    {
        $user = Auth::user();
        $preferences = $user->getNotificationPreferences();
        
        return view('notifications.preferences', compact('preferences'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'new_applications' => 'boolean',
            'status_changes' => 'boolean',
            'job_recommendations' => 'boolean',
            'marketing' => 'boolean',
        ]);

        $preferences = [
            'new_applications' => $request->boolean('new_applications'),
            'status_changes' => $request->boolean('status_changes'),
            'job_recommendations' => $request->boolean('job_recommendations'),
            'marketing' => $request->boolean('marketing'),
        ];

        Auth::user()->updateNotificationPreferences($preferences);

        return redirect()->back()->with('success', 'Preferencias de notificación actualizadas correctamente.');
    }
}
