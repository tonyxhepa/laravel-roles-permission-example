<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('/products', ProductController::class);

    Route::middleware(['can:access-admin'])->name('admin.')->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::resource('/products', AdminProductController::class);
        Route::resource('/posts', PostController::class);
        Route::resource('/settings', SettingController::class)->middleware('can:access-settings');
    });
});

require __DIR__ . '/auth.php';
