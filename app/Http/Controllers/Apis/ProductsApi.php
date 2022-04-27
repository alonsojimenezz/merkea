<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products as ModelsProducts;

class ProductsApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            $exist = ModelsProducts::where('Name', $request->input('name'))
                ->orWhere('Key', $request->input('key'))->first();
            if (!$exist) {

                $product = ModelsProducts::create([
                    'Key' => $request->input('key'),
                    'Name' => $request->input('name'),
                    'Active' => 1
                ]);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('Product saved successfully'),
                    'product' => $product
                ]);
            } else {
                return $this->jsonResponse(400, __('The product or product key already exists'));
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
        //
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
        //
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
