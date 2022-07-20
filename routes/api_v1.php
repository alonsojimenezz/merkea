<?php

use App\Http\Controllers\Apis\BranchOfficesApi;
use App\Http\Controllers\Apis\PostalCoverageApi;
use App\Http\Controllers\Apis\ProductCategoriesApi;
use App\Http\Controllers\Apis\ProductsApi;
use App\Http\Controllers\Apis\StaffApi;
use App\Http\Controllers\Apis\UnitsApi;
use App\Http\Controllers\Apis\OrderItem;
use App\Http\Controllers\Apis\Order;
use App\Http\Controllers\Store;
use App\Http\Controllers\Apis\Dashboard;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:Administrator|Staff']], function () {
    Route::prefix('api_v1')->group(function () {
        Route::apiResource('categories', ProductCategoriesApi::class);

        Route::apiResource('products', ProductsApi::class);

        Route::post('products/main_image_upload', [ProductsApi::class, 'uploadMainImage']);
        Route::post('products/status', [ProductsApi::class, 'changeProductStatus']);
        Route::post('products/category', [ProductsApi::class, 'changeProductCategory']);
        Route::post('products/highlight', [ProductsApi::class, 'highlightProduct']);
        Route::post('products/tags', [ProductsApi::class, 'changeProductTags']);
        Route::post('products/gallery', [ProductsApi::class, 'uploadGallery']);
        Route::post('products/gallery/delete', [ProductsApi::class, 'deleteGalleryImage']);
        Route::post('products/units', [ProductsApi::class, 'changeProductUnits']);
        Route::post('products/prices', [ProductsApi::class, 'setProductPrices']);
        Route::post('products/stock', [ProductsApi::class, 'setProductStock']);
        Route::post('products/upload_inventory', [ProductsApi::class, 'uploadInventory']);

        Route::apiResource('units', UnitsApi::class);

        Route::apiResource('staff', StaffApi::class);
        Route::put('staff/{id}/permission', StaffApi::class . '@updatePermission');

        Route::apiResource('branch_offices', BranchOfficesApi::class);

        Route::apiResource('postal_codes', PostalCoverageApi::class);

        Route::get('order_items/search', [ProductsApi::class, 'searchProducts']);
        Route::apiResource('order_items', OrderItem::class);

        Route::post('order/status', [Order::class, 'changeOrderStatus']);

        Route::get('dashboard/sales', [Dashboard::class, 'sales']);
    });
});

Route::prefix('api_v1')->group(function () {
    Route::post('store/change_branch', [Store::class, 'changeBranch']);
    Route::post('store/add_to_cart', [Store::class, 'addToCart']);
    Route::post('store/remove_from_cart', [Store::class, 'removeFromCart']);
    Route::post('store/empty_cart', [Store::class, 'emptyCart']);
    Route::post('store/update_cart', [Store::class, 'updateCart']);
    Route::post('store/checkout', [Store::class, 'completeOrder']);
    Route::post('store/update_personal_info', [Store::class, 'updatePersonalInfo']);
});
