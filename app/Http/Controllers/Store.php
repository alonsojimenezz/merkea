<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories as ModelsProductCategories;

class Store extends Controller
{
    public function index()
    {
        return view('store.index', [
            'categories' => ModelsProductCategories::getActivesTree()
        ]);
    }
}
