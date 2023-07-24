<?php

use App\Http\Controllers\API\PaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('payment')->group(function () {
    Route::post('/callback', [PaymentController::class, 'callback'])->name('api.payment.callback');
});
