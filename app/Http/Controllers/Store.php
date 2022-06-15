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

    public function show_department(Request $request, $department)
    {
        $department = ModelsProductCategories::where('Slug', $department)->whereNull('ParentId')->first();

        $viewArray = [
            'categories' => ModelsProductCategories::getActivesTree(),
            'products' => ModelsProducts::getProductsByDepartment(
                $department->Slug,
                $request->input('order', 'name'),
                $request->input('direction', 'asc'),
                $request->input('limit', 12),
                $request->input('page', 1),
                $request->input('branchId', 1)
            ),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => [
                    'text' => $department->Name,
                    'url' => route('store.department', $department->Slug)
                ]
            ]
        ];

        return view('store.department', $viewArray);
    }

    public function show_category(Request $request, $category)
    {
        $category = ModelsProductCategories::where('Slug', $category)->whereNotNull('ParentId')->first();
        $department = ModelsProductCategories::where('Id', $category->ParentId)->first();

        $viewArray = [
            'categories' => ModelsProductCategories::getActivesTree(),
            'products' => ModelsProducts::getProductsByCategory(
                $category->Id,
                $request->input('order', 'name'),
                $request->input('direction', 'asc'),
                $request->input('limit', 12),
                $request->input('page', 1),
                $request->input('branchId', 1)
            ),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => [
                    'text' => $department->Name,
                    'url' => route('store.department', $department->Slug),
                    'child' => [
                        'text' => $category->Name,
                        'url' => route('store.category', $category->Slug)
                    ]
                ]
            ]
        ];

        return view('store.department', $viewArray);
    }

    public function show_product()
    {
    }
}
