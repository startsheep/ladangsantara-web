<?php

use App\Http\Controllers\API\OrderStoreController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('order-store')->group(function () {
    Route::get('/', [OrderStoreController::class, 'index'])->name('api.order.store.index');
    Route::get('/{id}', [OrderStoreController::class, 'show'])->name('api.order.store.show');
    Route::put('/update-status', [OrderStoreController::class, 'updateStatus'])->name('api.order.store.update.status');
});
