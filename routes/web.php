<?php

use Illuminate\Support\Facades\Route;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    // Laboratory Management Routes
    Route::resource('laboratories', App\Http\Controllers\LaboratoryController::class);
    
    // Additional routes will be added as controllers are created
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
