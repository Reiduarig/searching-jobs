<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\NotificationPreferencesController;
use App\Http\Controllers\EmployerController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [JobController::class,'index'])->name('jobs');
Route::get('/jobs/{job}', [JobController::class,'show'])->name('jobs.show');

Route::get('/search', SearchController::class)->name('search');
Route::get('/tags/{tag:name}', TagController::class);


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class,'create'])->name('register');
    Route::post('/register', [RegisterUserController::class,'store']);
    Route::get('/login', [SessionController::class,'create'])->name('login');
    Route::post('/login', [SessionController::class,'store']);
});


Route::middleware('auth')->group(function () {
    // Dashboard unificado
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Aplicaciones (solo para candidatos)
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    
    // Sistema de favoritos/guardados
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved-jobs.index');
    Route::post('/jobs/{job}/save', [SavedJobController::class, 'store'])->name('saved-jobs.store');
    Route::delete('/jobs/{job}/save', [SavedJobController::class, 'destroy'])->name('saved-jobs.destroy');
    Route::post('/jobs/{job}/toggle-save', [SavedJobController::class, 'toggle'])->name('saved-jobs.toggle');
    
    // Preferencias de notificaciones
    Route::get('/notifications/preferences', [NotificationPreferencesController::class, 'show'])->name('notifications.preferences');
    Route::put('/notifications/preferences', [NotificationPreferencesController::class, 'update'])->name('notifications.update');
    
    // Rutas que requieren ser empleador
    Route::middleware('employer')->group(function () {
        Route::get('/jobs/create', [JobController::class,'create'])->name('jobs.create');
        Route::post('/jobs', [JobController::class,'store'])->name('jobs.store');
        
        // Dashboard y gestión de aplicaciones para empleadores
        Route::get('/employer/dashboard', [EmployerController::class, 'dashboard'])->name('employer.dashboard');
        Route::get('/employer/applications', [EmployerController::class, 'applications'])->name('employer.applications');
        Route::get('/employer/applications/{application}', [EmployerController::class, 'showApplication'])->name('employer.applications.show');
        Route::patch('/employer/applications/{application}/status', [EmployerController::class, 'updateApplicationStatus'])->name('employer.applications.update-status');
    });

    Route::delete('/logout', [SessionController::class,'destroy'])->name('logout');
});

// Rutas del chatbot
Route::post('/chatbot/message', [ChatbotController::class, 'processMessage'])->name('chatbot.message');
Route::get('/chatbot/faq', [ChatbotController::class, 'getFAQ'])->name('chatbot.faq');




