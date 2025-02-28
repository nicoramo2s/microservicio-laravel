<?php

use App\Http\Controllers\ApiGatewayController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::any('/{service}/{path?}', [ApiGatewayController::class, 'handleRequest'])->where('path', '.*');
});