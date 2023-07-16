<?php

use App\Http\Controllers\API\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('cart')->group(function () {
    Route::put('add-qty/{id}', [CartController::class, 'addQty'])->name('api.cart.add.qty');
    Route::put('reduce-qty/{id}', [CartController::class, 'reduceQty'])->name('api.cart.reduce.qty');
});
