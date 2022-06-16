<?php

use App\Http\Controllers\Store;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProductCategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Store::class, 'index'])->name('store.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/department/{department}', [Store::class, 'show_department'])->name('store.department');
Route::get('/category/{category}', [Store::class, 'show_category'])->name('store.category');
Route::get('/search', [Store::class, 'show_search'])->name('store.search');
Route::get('/product/{product}', [Store::class, 'show_product'])->name('store.product');

// Route::resource('/product-categories', ProductCategoriesController::class)->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';

require __DIR__ . '/api_v1.php';
