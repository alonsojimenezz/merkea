<?php

use App\Http\Controllers\Apis\BranchOfficesApi;
use App\Http\Controllers\Apis\PostalCoverageApi;
use App\Http\Controllers\Apis\ProductCategoriesApi;
use App\Http\Controllers\Apis\ProductsApi;
use App\Http\Controllers\Apis\StaffApi;
use App\Http\Controllers\Apis\UnitsApi;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:Administrator|Staff']], function () {
    Route::prefix('api_v1')->group(function () {
        Route::apiResource('categories', ProductCategoriesApi::class);

        Route::apiResource('products', ProductsApi::class);

        Route::post('products/main_image_upload', [ProductsApi::class, 'uploadMainImage']);
        Route::post('products/status', [ProductsApi::class, 'changeProductStatus']);
        Route::post('products/tags', [ProductsApi::class, 'changeProductTags']);
        Route::post('products/gallery', [ProductsApi::class, 'uploadGallery']);
        Route::post('products/gallery/delete', [ProductsApi::class, 'deleteGalleryImage']);
        Route::post('products/units', [ProductsApi::class, 'changeProductUnits']);
        Route::post('products/prices', [ProductsApi::class, 'setProductPrices']);
        Route::post('products/stock', [ProductsApi::class, 'setProductStock']);

        Route::apiResource('units', UnitsApi::class);

        Route::apiResource('staff', StaffApi::class);
        Route::put('staff/{id}/permission', StaffApi::class . '@updatePermission');

        Route::apiResource('branch_offices', BranchOfficesApi::class);

        Route::apiResource('postal_codes', PostalCoverageApi::class);
    });
});
