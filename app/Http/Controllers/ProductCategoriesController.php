<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        $data['categories'] = ProductCategories::orderBy('Name', 'asc')->paginate('10');
        return view('product-categories.index', $data);
    }
}
