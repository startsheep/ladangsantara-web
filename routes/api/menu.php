<?php

use Illuminate\Support\Facades\Route;

$listMenus = [
    'cart' => 'cart',
    'store' => 'store',
    'order' => 'order',
    'recipe' => 'recipe',
    'banner' => 'banner',
    'review' => 'review',
    'product' => 'product',
];

foreach ($listMenus as $key => $menu) {
    $name = ucfirst($key);
    $component = "App\\Http\\Controllers\\API\\$name" . "Controller";

    Route::prefix($menu)->name("api.$key.")->middleware(["auth:sanctum"])->group(function () use ($key, $component) {
        if (@class_exists($component)) {
            Route::get('/', [$component, 'index'])->name("index");
            Route::post('/', [$component, 'store'])->name("store");
            Route::get('/{id}', [$component, 'show'])->name("show");
            Route::put('/{id}', [$component, 'update'])->name("update");
            Route::delete('/{id}', [$component, 'destroy'])->name("destroy");
        }
    });
}
