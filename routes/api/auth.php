<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', LoginController::class)->name('api.auth.login');

    Route::post('register', RegisterController::class)->name('api.auth.register');
});
