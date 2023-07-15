<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

$listMenus = [
    'store' => 'store'
];

foreach ($listMenus as $key => $menu) {
    $name = ucfirst($key);
    $component = "App\\Http\\Livewire\\$name";

    Route::prefix($menu)->name("web.$key.")->group(function () use ($key, $component) {
        if (@class_exists("$component\\Index")) {
            Route::get('/', "$component\\Index")->name('index');
        }
        if (@class_exists("$component\\Create")) {
            Route::get('/create', "$component\\Create")->name('create');
        }
        if (@class_exists("$component\\Edit")) {
            Route::get('/{' . $key . '}/edit', "$component\\Edit")->name('edit');
        }
        if (@class_exists("$component\\Detail")) {
            Route::get('/detail/{' . $key . '}', "$component\\Detail")->name('detail');
        }
        if (@class_exists("$component\\Delete")) {
            Route::delete('/{' . $key . '}', "$component\\Delete")->name('delete');
        }
    });
}

require __DIR__ . '/auth.php';
