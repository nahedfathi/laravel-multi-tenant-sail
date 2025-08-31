<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TenantAuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TenantDataController;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

Route::middleware(['api',InitializeTenancyByPath::class,"universal"])->group(function(){

    Route::prefix('auth')->group(function () {
        Route::post('register', [TenantAuthController::class, 'register']);
        Route::post('login', [TenantAuthController::class, 'login']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/me', function () {
            return auth()->user();
        });
        Route::get('/tenant-data', [TenantDataController::class, 'index']);
        // Jobs APIs
        Route::prefix('jobs')->group(function () {
            Route::post('/', [JobController::class, 'store']);  
            Route::get('/', [JobController::class, 'index']);
        });
    });
});
