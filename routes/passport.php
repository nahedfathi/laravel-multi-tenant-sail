<?php

use Laravel\Passport\Http\Controllers\AccessTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/token', [AccessTokenController::class, 'issueToken'])->name('passport.token');
