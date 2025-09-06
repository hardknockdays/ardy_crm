<?php

use Illuminate\Support\Facades\Route;
// Import semua controller yang dipakai
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\ProjectController;
// use App\Http\Controllers\CustomerController;
// use App\Http\Controllers\ReportController;

Route::get('/ping', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is working in Laravel 12 🚀'
    ]);
});

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('leads', LeadController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('customers', CustomerController::class);

    // Reports
    Route::get('/reports/sales', [ReportController::class, 'sales']);
    Route::get('/reports/customers', [ReportController::class, 'customers']);
});
