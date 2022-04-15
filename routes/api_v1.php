<?php

use App\Http\Controllers\Apis\ProductCategoriesApi;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:Administrator']], function () {
    Route::prefix('api_v1')->group(function () {
        Route::apiResource('categories', ProductCategoriesApi::class);
    });
});
