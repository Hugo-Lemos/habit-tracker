<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Site
Route::get('/', [SiteController::class, 'index'])->name('site.index');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');

Route::get('cadastro', [RegisterController::class, 'index'])->name('site.register');
Route::post('cadastro', [RegisterController::class, 'store'])->name('auth.register');

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('site.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

    Route::get('/dashboard/habits/create', [HabitController::class, 'create'])->name('habit.create');
    Route::post('/dashboard/habits', [HabitController::class, 'store'])->name('habit.store');
    Route::delete('/dashboard/habits/{habit}', [HabitController::class, 'destroy'])->name('habit.destroy');
    Route::get('/dashboard/habits/{habit}/edit', [HabitController::class, 'edit'])->name('habit.edit');
    Route::put('/dashboard/habits/{habit}', [HabitController::class, 'update'])->name('habit.update');
    Route::get('/dashboard/habits/configurar', [HabitController::class, 'settings'])->name('habits.settings');
    Route::post('/dashboard/habits/{habit}/toggle', [HabitController::class, 'toggle'])->name('habit.toggle');
});
