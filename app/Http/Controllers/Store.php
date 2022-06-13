<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories as ModelsProductCategories;
use App\Models\Products as ModelsProducts;

class Store extends Controller
{
    public function index()
    {
        return view('store.index', [
            'featured_products' => ModelsProducts::getFeaturedProducts(),
            'categories' => ModelsProductCategories::getActivesTree()
        ]);
    }
}
