<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\WeatherController;
use App\Http\Controllers\API\EconomyController;
use App\Http\Controllers\API\CurrencyController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\RiskController;
use App\Http\Controllers\API\RiskRankingController;
use App\Http\Controllers\API\RiskGeneratorController;
use App\Http\Controllers\API\PortController;
use App\Http\Controllers\API\WatchlistController;
use App\Http\Controllers\API\ComparisonController;
use App\Http\Controllers\API\AdminController;

/*
|--------------------------------------------------------------------------
| Global Supply Chain Risk Intelligence API Routes
|--------------------------------------------------------------------------
*/

// Country & Indicator Endpoints
Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/{code}', [CountryController::class, 'show']);
Route::get('/weather/{code}', [WeatherController::class, 'show']);
Route::get('/economy/{code}', [EconomyController::class, 'show']);
Route::get('/currency/{code}', [CurrencyController::class, 'show']);
Route::get('/news/{code}', [NewsController::class, 'show']);

// Risk Scoring & Intelligence Endpoints
Route::get('/risk', [RiskController::class, 'index']);
Route::get('/risk-ranking', [RiskController::class, 'ranking']);
Route::get('/risk-generate-all', [RiskGeneratorController::class, 'generate']);
Route::get('/risk-history/{code}', [RiskController::class, 'history']);
Route::get('/risk/{code}', [RiskController::class, 'show']);

// World Ports & Geolocation Endpoints
Route::get('/ports', [PortController::class, 'index']);
Route::get('/ports/{id}', [PortController::class, 'show']);

// Country Comparison Engine
Route::get('/compare/{code1}/{code2}', [ComparisonController::class, 'compare']);

// Watchlist & Bookmarks
Route::get('/watchlists', [WatchlistController::class, 'index']);
Route::post('/watchlists', [WatchlistController::class, 'store']);
Route::delete('/watchlists/{id}', [WatchlistController::class, 'destroy']);

// Admin Dashboard Endpoints
Route::get('/admin/users', [AdminController::class, 'users']);
Route::put('/admin/users/{id}/role', [AdminController::class, 'updateUserRole']);
Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser']);

Route::post('/admin/ports', [AdminController::class, 'storePort']);
Route::put('/admin/ports/{id}', [AdminController::class, 'updatePort']);
Route::delete('/admin/ports/{id}', [AdminController::class, 'deletePort']);

Route::get('/admin/articles', [AdminController::class, 'articles']);
Route::post('/admin/articles', [AdminController::class, 'storeArticle']);
Route::put('/admin/articles/{id}', [AdminController::class, 'updateArticle']);
Route::delete('/admin/articles/{id}', [AdminController::class, 'deleteArticle']);