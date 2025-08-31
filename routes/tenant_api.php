<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\UserAuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TenantController;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

Route::middleware(['api',InitializeTenancyByPath::class,"universal"])->group(function(){

    Route::prefix('auth')->group(function () {
        Route::post('register', [UserAuthController::class, 'register']);
        Route::post('login', [UserAuthController::class, 'login']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/me', function () {
            return auth()->user();
        });
        Route::get('/tenant-data', [TenantController::class, 'index']);
        // Jobs APIs
        Route::prefix('jobs')->group(function () {
            Route::post('/', [JobController::class, 'store']);  
            Route::get('/', [JobController::class, 'index']);
        });
    });
});
