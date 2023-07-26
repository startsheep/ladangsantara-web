<?php

use App\Http\Controllers\API\XenditController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('xendit')->group(function () {
    Route::get('/va-list', [XenditController::class, 'VALists'])
        ->name('api.xendit.va.lists');
});
