<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'funciona';
});
Route::prefix('v1')->group(function () {
    Route::prefix('email')->controller(EmailController::class)->group(function () {
        Route::post('/', 'sendEmail');
    });
});
