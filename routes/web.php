<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/**
 * API Routes - Start
 */

// Public routes
Route::post('/login', [AuthController::class, 'login']);

// Logged in routes
Route::middleware(['auth'])->group(function () {
    Route::get('/authenticated', [AuthController::class, 'authenticated']);

    Route::get('/task', [TaskController::class, 'show']);
    Route::post('/task', [TaskController::class, 'store']);
    Route::delete('/task/{task_id}', [TaskController::class, 'destroy']);
});

/**
 * API Routes - End
 */

/**
 * React routes - start
 */
foreach (['/', '/home'] as $route) {
    Route::get($route, function () {
        return view('welcome');
    });
}

/**
 * React routes - end
 */
