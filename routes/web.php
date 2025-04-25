<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/generate-id', [AgentController::class,'generateIds']);
    Route::get('/agents', [AgentController::class, 'index'])->name('agents');
    Route::get('/mentora/students', [DashboardController::class, 'index'])->name('students.dashboard');  
    Route::get('/mentora/lectures', [DashboardController::class, 'index'])->name('lectures.dashboard');  
});

require __DIR__.'/auth.php';
