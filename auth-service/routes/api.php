<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});

Route::prefix('v1')->middleware(['api'])->group(function () {
    Route::prefix('auth')->group(function () {
        // Rutas públicas (sin autenticación)
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

        // Rutas protegidas (requieren autenticación)
        Route::middleware(['jwt.verify'])->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::get('me', [AuthController::class, 'me']);
        });
    });
});