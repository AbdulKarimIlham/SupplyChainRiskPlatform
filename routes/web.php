<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

function ensureDatabaseInitialized() {
    try {
        if (!Schema::hasTable('users') || !Schema::hasTable('countries')) {
            Artisan::call('migrate', ['--force' => true]);
        }
        if (Schema::hasTable('countries') && \App\Models\Country::count() < 100) {
            Artisan::call('db:seed', ['--force' => true]);
        }
    } catch (\Throwable $e) {
        Log::error("Database Auto-Init Error: " . $e->getMessage());
    }
}

Route::get('/', function () {
    ensureDatabaseInitialized();
    return view('dashboard');
});

Route::get('/dashboard', function () {
    ensureDatabaseInitialized();
    return view('dashboard');
})->name('dashboard');

// Manual database setup route helper
Route::get('/setup-db', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
        return response()->json([
            'success' => true,
            'message' => 'Database migration and seeding completed successfully!',
            'countries_count' => \App\Models\Country::count(),
            'risk_scores_count' => \App\Models\RiskScore::count(),
            'weather_records' => \App\Models\WeatherData::count(),
            'economic_records' => \App\Models\EconomicData::count()
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
