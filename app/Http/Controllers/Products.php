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
            'products' => ModelsProducts::orderBy('Name')->get(),
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
}
