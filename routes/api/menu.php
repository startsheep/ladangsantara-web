<?php

use Illuminate\Support\Facades\Route;

$listMenus = [
    'product' => 'product'
];

foreach ($listMenus as $key => $menu) {
    $name = ucfirst($key);
    $component = "App\\Http\\Controllers\\API\\$name";

    Route::prefix($menu)->name("api.$key.")->group(function () use ($key, $component) {
        if (@class_exists($component)) {
            Route::get('/', [$component::class, 'index'])->name("index");
            Route::post('/', [$component::class, 'store'])->name("store");
            Route::get('/{id}', [$component::class, 'show'])->name("show");
            Route::put('/{id}', [$component::class, 'update'])->name("update");
            Route::delete('/{id}', [$component::class, 'destroy'])->name("destroy");
        }
    });
}
