<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\OrdreMissionController;

Route::middleware(['auth'])->group(function () {
    Route::resource('ordres-mission', OrdreMissionController::class);
    Route::get('ordres-mission/{ordres_mission}/imprimer', [OrdreMissionController::class, 'imprimer'])->name('ordres-mission.imprimer');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('ordres-mission', OrdreMissionController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/reclamations', [ReclamationController::class, 'index'])->name('reclamations.index');
    Route::get('/reclamations/create', [ReclamationController::class, 'create'])->name('reclamations.create');
    Route::post('/reclamations', [ReclamationController::class, 'store'])->name('reclamations.store');
    Route::put('/reclamations/{reclamation}', [ReclamationController::class, 'update'])->name('reclamations.update');
});

// Rediriger la racine directement vers la page de connexion
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';