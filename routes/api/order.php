<?php

use App\Http\Controllers\API\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('order')->group(function () {
    Route::put('cancel/{id}', [OrderController::class, 'cancel'])->name('api.order.cancel');
});
