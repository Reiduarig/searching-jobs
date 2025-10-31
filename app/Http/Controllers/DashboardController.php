<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isEmployer()) {
            // Datos reales del empleador
            $employer = $user->employer;
            
            $stats = [
                'active_jobs' => $employer->jobs()->where('is_active', true)->count(),
                'total_applications' => \App\Models\Application::whereHas('job', function ($q) use ($employer) {
                    $q->where('employer_id', $employer->id);
                })->count(),
                'pending_applications' => \App\Models\Application::whereHas('job', function ($q) use ($employer) {
                    $q->where('employer_id', $employer->id);
                })->where('status', 'pending')->count(),
                'interviews_scheduled' => \App\Models\Application::whereHas('job', function ($q) use ($employer) {
                    $q->where('employer_id', $employer->id);
                })->where('status', 'interviewed')->count(),
            ];
            
            // Aplicaciones recientes
            $recent_applications = \App\Models\Application::with(['user', 'job'])
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
            
            return view('dashboard.company', compact('stats', 'recent_applications', 'popular_jobs'));
        } else {
            // Dashboard para candidatos
            $stats = [
                'applied_jobs' => $user->applications()->count(),
                'interviews' => $user->applications()->where('status', 'interviewed')->count(),
                'saved_jobs' => $user->savedJobs()->count(),
                'profile_views' => 156,
            ];
            
            // Aplicaciones recientes reales
            $recent_applications = $user->applications()
                ->with(['job.employer'])
                ->latest('applied_at')
                ->take(3)
                ->get();
            
            // Trabajos guardados recientes
            $saved_jobs = $user->savedJobs()
                ->with(['job.employer', 'job.tags'])
                ->latest('saved_at')
                ->take(3)
                ->get();
            
            // Trabajos recomendados mejorados (basados en tags de aplicaciones previas y trabajos guardados)
            $userInterestTags = collect();
            
            // Obtener tags de trabajos a los que ha aplicado
            $appliedJobTags = $user->applications()
                ->with('job.tags')
                ->get()
                ->pluck('job.tags')
                ->flatten()
                ->pluck('name')
                ->unique();
            
            // Obtener tags de trabajos guardados
            $savedJobTags = $user->savedJobs()
                ->with('job.tags')
                ->get()
                ->pluck('job.tags')
                ->flatten()
                ->pluck('name')
                ->unique();
            
            $userInterestTags = $appliedJobTags->merge($savedJobTags)->unique();
            
            // Buscar trabajos recomendados basados en intereses
            $recommended_jobs = Job::with(['employer', 'tags'])
                ->where(function ($query) use ($user) {
                    // Excluir trabajos a los que ya aplicó
                    $appliedJobIds = $user->applications()->pluck('job_id');
                    if ($appliedJobIds->isNotEmpty()) {
                        $query->whereNotIn('id', $appliedJobIds);
                    }
                    
                    // Excluir trabajos ya guardados
                    $savedJobIds = $user->savedJobs()->pluck('job_id');
                    if ($savedJobIds->isNotEmpty()) {
                        $query->whereNotIn('id', $savedJobIds);
                    }
                })
                ->when($userInterestTags->isNotEmpty(), function ($query) use ($userInterestTags) {
                    // Si tiene tags de interés, priorizar trabajos con esos tags
                    $query->whereHas('tags', function ($q) use ($userInterestTags) {
                        $q->whereIn('name', $userInterestTags);
                    });
                }, function ($query) {
                    // Si no tiene intereses previos, mostrar trabajos destacados o recientes
                    $query->where(function ($q) {
                        $q->where('featured', true)->orWhere('urgent', true);
                    })->orWhere('created_at', '>=', now()->subDays(7));
                })
                ->latest()
                ->take(3)
                ->get();
            
            // Si no hay suficientes trabajos basados en intereses, completar con trabajos recientes
            if ($recommended_jobs->count() < 3) {
                $recommendedJobIds = $recommended_jobs->pluck('id');
                $additionalJobs = Job::with(['employer', 'tags'])
                    ->where(function ($query) use ($user, $recommendedJobIds) {
                        // Excluir trabajos a los que ya aplicó
                        $appliedJobIds = $user->applications()->pluck('job_id');
                        if ($appliedJobIds->isNotEmpty()) {
                            $query->whereNotIn('id', $appliedJobIds);
                        }
                        
                        // Excluir trabajos ya guardados
                        $savedJobIds = $user->savedJobs()->pluck('job_id');
                        if ($savedJobIds->isNotEmpty()) {
                            $query->whereNotIn('id', $savedJobIds);
                        }
                        
                        // Excluir trabajos ya recomendados
                        if ($recommendedJobIds->isNotEmpty()) {
                            $query->whereNotIn('id', $recommendedJobIds);
                        }
                    })
                    ->latest()
                    ->take(3 - $recommended_jobs->count())
                    ->get();
                
                $recommended_jobs = $recommended_jobs->merge($additionalJobs);
            }
            
            return view('dashboard.user', compact('stats', 'recommended_jobs', 'saved_jobs', 'recent_applications'));
        }
    }
}
