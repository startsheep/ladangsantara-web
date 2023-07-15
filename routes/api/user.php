<?php

use App\Http\Controllers\API\User\CheckStoreController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('user')->group(function () {
    Route::prefix('check')->group(function () {
        Route::post('store', CheckStoreController::class);
    });
});
