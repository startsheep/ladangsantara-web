<?php

use App\Http\Controllers\API\User\AddressController;
use App\Http\Controllers\API\User\CheckStoreController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('user')->group(function () {
    Route::prefix('check')->group(function () {
        Route::post('store', CheckStoreController::class);
    });

    Route::prefix('address')->group(function () {
        Route::get('/', [AddressController::class, 'index'])->name('api.user.address.index');
        Route::post('/', [AddressController::class, 'store'])->name('api.user.address.store');
        Route::get('/{id}', [AddressController::class, 'show'])->name('api.user.address.show');
        Route::put('/{id}', [AddressController::class, 'update'])->name('api.user.address.update');
        Route::delete('/{id}', [AddressController::class, 'destroy'])->name('api.user.address.destroy');
    });
});
