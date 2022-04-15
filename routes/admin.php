<?php

use App\Http\Controllers\ProductCategories;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:Administrator']], function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->middleware(['auth', 'verified'])->name('admin.index');

        Route::get('/product-categories', [ProductCategories::class, 'index'])->middleware(['auth', 'verified'])->name('admin.pcategories');

        Route::get('/products', function () {
            return view('admin.products');
        })->middleware(['auth', 'verified'])->name('admin.products');
    });
});
