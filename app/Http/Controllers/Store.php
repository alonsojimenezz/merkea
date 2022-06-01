<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories as ModelsProductCategories;

class Store extends Controller
{
    public function index()
    {
        $categories = ModelsProductCategories::getActives();
        return view('store.index', [
            'categories' => $categories
        ]);
    }
}
