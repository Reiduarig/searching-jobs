<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Mail\NewApplicationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\File;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        // Verificar que el usuario no sea empleador
        if (Auth::user()->isEmployer()) {
            return back()->with('error', 'Los empleadores no pueden aplicar a trabajos.');
        }

        // Verificar que no haya aplicado ya
        if (Auth::user()->hasAppliedTo($job)) {
            return back()->with('warning', 'Ya has aplicado a este trabajo.');
        }

        $validated = $request->validate([
            'cover_letter' => ['nullable', 'string', 'max:2000'],
            'cv_file' => ['nullable', 'file', File::types(['pdf', 'doc', 'docx'])->max(5120)], // 5MB
        ]);

        // Subir CV si se proporciona
        $cvPath = null;
        if ($request->hasFile('cv_file')) {
            $cvPath = $request->file('cv_file')->store('cvs', 'public');
        }

        // Crear la aplicación
        $application = Application::create([
            'user_id' => Auth::id(),
            'job_id' => $job->id,
            'cover_letter' => $validated['cover_letter'],
            'cv_path' => $cvPath,
            'applied_at' => now(),
        ]);

        // Enviar notificación por email al empleador
        try {
            Mail::to($job->employer->user->email)
                ->send(new NewApplicationNotification($application));
        } catch (\Exception $e) {
            // Log el error pero no fallar la aplicación
            Log::error('Error enviando email de nueva aplicación: ' . $e->getMessage());
        }

        return back()->with('success', '¡Aplicación enviada exitosamente! El empleador revisará tu solicitud.');
    }

    public function index(Request $request)
    {
        $query = Auth::user()->applications()
            ->with(['job', 'job.employer']);

        // Filtro por estado
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filtro por empresa
        if ($request->filled('company')) {
            $query->whereHas('job.employer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->company . '%');
            });
        }

        // Filtro por título del trabajo
        if ($request->filled('job_title')) {
            $query->whereHas('job', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->job_title . '%');
            });
        }

        // Filtro por fecha
        if ($request->filled('date_from')) {
            $query->where('applied_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('applied_at', '<=', $request->date_to . ' 23:59:59');
        }

        // Filtro por rango de fechas predefinido
        if ($request->filled('date_range') && $request->date_range !== 'all') {
            switch ($request->date_range) {
                case 'today':
                    $query->whereDate('applied_at', today());
                    break;
                case 'week':
                    $query->where('applied_at', '>=', now()->subWeek());
                    break;
                case 'month':
                    $query->where('applied_at', '>=', now()->subMonth());
                    break;
                case '3months':
                    $query->where('applied_at', '>=', now()->subMonths(3));
                    break;
            }
        }

        // Ordenamiento
        $sortBy = $request->get('sort_by', 'applied_at');
        $sortOrder = $request->get('sort_order', 'desc');

        if (in_array($sortBy, ['applied_at', 'status', 'updated_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('applied_at', 'desc');
        }

        $applications = $query->paginate(10)->appends($request->query());

        // Estadísticas para la vista
        $stats = [
            'total' => Auth::user()->applications()->count(),
            'pending' => Auth::user()->applications()->where('status', 'pending')->count(),
            'interviewed' => Auth::user()->applications()->where('status', 'interviewed')->count(),
            'rejected' => Auth::user()->applications()->where('status', 'rejected')->count(),
            'accepted' => Auth::user()->applications()->where('status', 'accepted')->count(),
        ];

        // Lista de empresas para el filtro
        $companies = Auth::user()->applications()
            ->with('job.employer')
            ->get()
            ->pluck('job.employer.name')
            ->unique()
            ->sort()
            ->values();

        return view('applications.index', compact('applications', 'stats', 'companies'));
    }

    public function show(Application $application)
    {
        // Verificar que la aplicación pertenece al usuario actual
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        return view('applications.show', compact('application'));
    }

    public function destroy(Application $application)
    {
        // Verificar que la aplicación pertenece al usuario actual
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        // Solo permitir cancelar aplicaciones pendientes
        if ($application->status !== 'pending') {
            return back()->with('error', 'No puedes cancelar esta aplicación.');
        }

        $application->delete();

        return back()->with('success', 'Aplicación cancelada exitosamente.');
    }
}
