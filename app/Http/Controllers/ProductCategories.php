<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories as ModelsProductCategories;
use Illuminate\Support\Facades\Auth;

class ProductCategories extends Controller
{
    public function index()
    {
        return view('admin.product_categories.index', [
            'categories' => ModelsProductCategories::getAll()
        ]);
    }
}
