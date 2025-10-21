<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;

Route::get('/', [JobController::class,'index'])->name('jobs');

Route::get('/search', SearchController::class)->name('search');
Route::get('/tags/{tag:name}', TagController::class);


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class,'create'])->name('register');
    Route::post('/register', [RegisterUserController::class,'store']);
    Route::get('/login', [SessionController::class,'create'])->name('login');
    Route::post('/login', [SessionController::class,'store']);
});


Route::middleware('auth')->group(function () {

    Route::get('/jobs/create', [JobController::class,'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class,'store'])->name('jobs.store');
    Route::delete('/logout', [SessionController::class,'destroy'])->name('logout');

});




