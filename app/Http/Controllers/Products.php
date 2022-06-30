<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products as ModelsProducts;
use App\Models\Units as ModelsUnits;
use App\Models\BranchOffices as ModelsBranch;
use App\Models\ProductCategories as ModelsCategories;

class Products extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => ModelsProducts::getProductsForAdmin(),
            'branches' => ModelsBranch::all()->sortBy('Name')
        ]);
    }

    public function show_product($id)
    {
        return view('admin.products.product', [
            'product' => ModelsProducts::AllData($id),
            'units' => ModelsUnits::where('Active', 1)->orderBy('Name', 'asc')->get(),
            'categories' => ModelsCategories::getChilds(),
            'branches' => ModelsBranch::all()->sortBy('Name'),
        ]);
    }

    public static function product_image($sku)
    {
        // return asset('files/products/initials/' . $sku . '.jpg');
        if (file_exists(public_path('files/products/initials/' . $sku . '.jpg')))
            return asset('files/products/initials/' . $sku . '.jpg');

        if (file_exists(public_path('files/products/initials/' . $sku . '.jpeg')))
            return asset('files/products/initials/' . $sku . '.jpeg');

        if (file_exists(public_path('files/products/initials/' . $sku . '.png')))
            return asset('files/products/initials/' . $sku . '.png');

        if (file_exists(public_path('files/products/initials/' . $sku . '.webp')))
            return asset('files/products/initials/' . $sku . '.webp');

        return  asset('img/no_image.png');
    }
}
