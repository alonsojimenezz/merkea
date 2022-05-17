<?php

use App\Http\Controllers\ProductCategories;
use App\Http\Controllers\Products;
use App\Http\Controllers\Staff;
use App\Http\Controllers\Units;
use App\Http\Controllers\BranchOffices;
use App\Http\Controllers\PostalCoverage;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:Administrator|Staff']], function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->middleware(['auth', 'verified'])->name('admin.index');

        Route::get('/product-categories', [ProductCategories::class, 'index'])->middleware(['auth', 'verified', 'permission:View Product Categories'])->name('admin.pcategories');

        Route::get('/products', [Products::class, 'index'])->middleware(['auth', 'verified', 'permission:View Products'])->name('admin.products');

        Route::get('/products/{id}', [Products::class, 'show_product'])->middleware(['auth', 'verified', 'permission:View Products'])->name('admin.show_product');

        Route::get('/units', [Units::class, 'index'])->middleware(['auth', 'verified', 'permission:View Units of measure'])->name('admin.units');

        Route::get('/staff', [Staff::class, 'index'])->middleware(['auth', 'verified', 'permission:View Staff'])->name('admin.staff');

        Route::get('/staff/{id}', [Staff::class, 'view_staff'])->middleware(['auth', 'verified', 'permission:View Staff'])->name('admin.view_staff');

        Route::get('/branch-offices', [BranchOffices::class, 'index'])->middleware(['auth', 'verified', 'permission:View Branch Offices'])->name('admin.branch_offices');

        Route::get('/postal-coverage', [PostalCoverage::class, 'index'])->middleware(['auth', 'verified', 'permission:View Postal Code Coverage'])->name('admin.postal_coverage');
    });
});
