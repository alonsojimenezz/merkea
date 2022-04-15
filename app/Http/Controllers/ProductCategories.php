<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories as ModelsProductCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductCategories extends Controller
{
    public function index()
    {
        // $categories = ModelsProductCategories::orderBy('Name')->get();
        return view('admin.product_categories.index', [
            'categories' => ModelsProductCategories::getAll()
        ]);
    }
}
