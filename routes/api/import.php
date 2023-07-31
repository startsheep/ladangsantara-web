<?php

use App\Http\Controllers\API\Import\RecipeController;
use Illuminate\Support\Facades\Route;

Route::prefix('import')->group(function () {
    Route::post('recipe', RecipeController::class)->name('api.import.recipe');
});
