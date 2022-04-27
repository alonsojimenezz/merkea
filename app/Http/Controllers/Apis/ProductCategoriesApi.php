<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories as ModelsProductCategories;
use Illuminate\Http\Request;

class ProductCategoriesApi extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:View Product Categories')->only('index', 'show');
        $this->middleware('permission:Edit Product Categories')->only('update');
        $this->middleware('permission:Add Product Categories')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->jsonResponse(200, 'Loaded', ['categories' => ModelsProductCategories::getAll()]);
        } catch (\Exception $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $exist = ModelsProductCategories::where('Name', $request->input('name'))
                ->where('ParentId', $request->input('parent'))->first();
            if (!$exist) {

                $category = ModelsProductCategories::create([
                    'Name' => $request->input('name'),
                    'Description' => $request->input('description'),
                    'Active' => $request->input('active'),
                    'ParentId' => $request->input('parent'),
                ]);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('Category saved successfully'),
                    'category' => $category
                ]);
            } else {
                return $this->jsonResponse(400, __('Category already exists'));
            }
        } catch (\Exception $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->jsonResponse(200, 'Loaded', ['category' => ModelsProductCategories::getOne($id)]);
        } catch (\Exception $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $exist = ModelsProductCategories::where('Name', $request->input('name'))
                ->where('ParentId', $request->input('parent'))
                ->where('Id', "<>", $id)->first();
            if (!$exist) {

                ModelsProductCategories::where('Id', $id)->update([
                    'Name' => $request->input('name'),
                    'Description' => $request->input('description'),
                    'Active' => $request->input('active'),
                    'ParentId' => $request->input('parent'),
                ]);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('Category saved successfully')
                ]);
            } else {
                return $this->jsonResponse(400, __('Category already exists'));
            }
        } catch (\Exception $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
