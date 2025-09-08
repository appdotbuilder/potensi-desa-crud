<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemografiController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Demografi routes
    Route::resource('demografis', DemografiController::class);
    
    // UMKM routes
    Route::resource('umkms', UmkmController::class);
    
    // Additional module routes can be added here
    // Route::resource('fasilitas-umums', FasilitasUmumController::class);
    // Route::resource('pendidikans', PendidikanController::class);
    // Route::resource('kesehatans', KesehatanController::class);
    // Route::resource('pariwisata-budayas', PariwisataBudayaController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';