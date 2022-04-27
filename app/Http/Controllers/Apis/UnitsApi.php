<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Units as ModelsUnits;
use Illuminate\Http\Request;

class UnitsApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $exist = ModelsUnits::where('Name', $request->input('name'))
                ->orWhere('Key', $request->input('key'))->first();
            if (!$exist) {

                $product = ModelsUnits::create([
                    'Key' => $request->input('key'),
                    'Name' => $request->input('name'),
                    'Active' => 1
                ]);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('Unit of measure saved successfully'),
                    'product' => $product
                ]);
            } else {
                return $this->jsonResponse(400, __('The unit of measure or key already exists'));
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
            return $this->jsonResponse(200, 'Loaded', ['unit' => ModelsUnits::findOrFail($id)]);
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
            $exist = ModelsUnits::where('Name', $request->input('name'))
                ->where('Key', $request->input('key'))
                ->where('Id', "<>", $id)->first();
            if (!$exist) {

                ModelsUnits::where('Id', $id)->update([
                    'Name' => $request->input('name'),
                    'Key' => $request->input('key'),
                    'Active' => $request->input('active')
                ]);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('Unit of measure saved successfully')
                ]);
            } else {
                return $this->jsonResponse(400, __('The unit of measure or key already exists'));
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
