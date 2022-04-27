<?php

use App\Http\Controllers\Apis\ProductCategoriesApi;
use App\Http\Controllers\Apis\ProductsApi;
use App\Http\Controllers\Apis\StaffApi;
use App\Http\Controllers\Apis\UnitsApi;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:Administrator|Staff']], function () {
    Route::prefix('api_v1')->group(function () {
        Route::apiResource('categories', ProductCategoriesApi::class);
        Route::apiResource('products', ProductsApi::class);
        Route::apiResource('units', UnitsApi::class);
        Route::apiResource('staff', StaffApi::class);
        Route::put('staff/{id}/permission', StaffApi::class . '@updatePermission');
    });
});
