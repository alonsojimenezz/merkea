<?php

use App\Http\Controllers\ProductCategories;
use App\Http\Controllers\Products;
use App\Http\Controllers\Staff;
use App\Http\Controllers\Units;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:Administrator|Staff']], function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->middleware(['auth', 'verified'])->name('admin.index');

        Route::get('/product-categories', [ProductCategories::class, 'index'])->middleware(['auth', 'verified', 'permission:View Product Categories'])->name('admin.pcategories');

        Route::get('/products', [Products::class, 'index'])->middleware(['auth', 'verified', 'permission:View Products'])->name('admin.products');

        Route::get('/units', [Units::class, 'index'])->middleware(['auth', 'verified', 'permission:View Units of measure'])->name('admin.units');

        Route::get('/staff', [Staff::class, 'index'])->middleware(['auth', 'verified', 'permission:View Staff'])->name('admin.staff');

        Route::get('/staff/{id}', [Staff::class, 'view_staff'])->middleware(['auth', 'verified', 'permission:View Staff'])->name('admin.view_staff');
    });
});
