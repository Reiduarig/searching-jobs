<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Mail\ApplicationStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmployerController extends Controller
{
    public function applications(Request $request)
    {
        $employer = Auth::user()->employer;
        
        $query = Application::with(['user', 'job'])
            ->whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            });

        // Filtro por estado
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filtro por trabajo específico
        if ($request->filled('job_id') && $request->job_id !== 'all') {
            $query->where('job_id', $request->job_id);
        }

        // Filtro por fecha
        if ($request->filled('date_from')) {
            $query->where('applied_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('applied_at', '<=', $request->date_to . ' 23:59:59');
        }

        // Búsqueda por nombre del candidato
        if ($request->filled('candidate_search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->candidate_search . '%')
                  ->orWhere('email', 'like', '%' . $request->candidate_search . '%');
            });
        }

        // Ordenamiento
        $sortBy = $request->get('sort_by', 'applied_at');
        $sortOrder = $request->get('sort_order', 'desc');

        if (in_array($sortBy, ['applied_at', 'status', 'updated_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('applied_at', 'desc');
        }

        $applications = $query->paginate(15)->appends($request->query());

        // Estadísticas
        $stats = [
            'total' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->count(),
            'pending' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->where('status', 'pending')->count(),
            'interviewed' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->where('status', 'interviewed')->count(),
            'accepted' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->where('status', 'accepted')->count(),
            'rejected' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->where('status', 'rejected')->count(),
        ];

        // Lista de trabajos para el filtro
        $jobs = $employer->jobs()->select('id', 'title')->get();

        return view('employer.applications.index', compact('applications', 'stats', 'jobs'));
    }

    public function showApplication(Application $application)
    {
        $employer = Auth::user()->employer;
        
        // Verificar que la aplicación pertenece a un trabajo del empleador
        if ($application->job->employer_id !== $employer->id) {
            abort(403);
        }

        return view('employer.applications.show', compact('application'));
    }

    public function updateApplicationStatus(Request $request, Application $application)
    {
        $employer = Auth::user()->employer;
        
        // Verificar que la aplicación pertenece a un trabajo del empleador
        if ($application->job->employer_id !== $employer->id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,interviewed,accepted,rejected',
            'notes' => 'nullable|string|max:1000',
        ]);

        $oldStatus = $application->status;
        
        $application->update([
            'status' => $request->status,
            'employer_notes' => $request->notes,
        ]);

        // El Observer se encargará de enviar el email automáticamente

        $statusMessages = [
            'pending' => 'La aplicación ha sido marcada como pendiente',
            'interviewed' => 'El candidato ha sido convocado para entrevista',
            'accepted' => 'La aplicación ha sido aceptada',
            'rejected' => 'La aplicación ha sido rechazada',
        ];

        return back()->with('success', $statusMessages[$request->status]);
    }

    public function dashboard()
    {
        $employer = Auth::user()->employer;

        $stats = [
            'active_jobs' => $employer->jobs()->where('is_active', true)->count(),
            'total_applications' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->count(),
            'pending_applications' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->where('status', 'pending')->count(),
            'interviews_scheduled' => Application::whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })->where('status', 'interviewed')->count(),
        ];

        // Aplicaciones recientes
        $recent_applications = Application::with(['user', 'job'])
            ->whereHas('job', function ($q) use ($employer) {
                $q->where('employer_id', $employer->id);
            })
            ->orderBy('applied_at', 'desc')
            ->take(5)
            ->get();

        // Trabajos más populares (con más aplicaciones)
        $popular_jobs = Job::where('employer_id', $employer->id)
            ->withCount('applications')
            ->orderBy('applications_count', 'desc')
            ->take(5)
            ->get();

        return view('employer.dashboard', compact('stats', 'recent_applications', 'popular_jobs'));
    }
}
