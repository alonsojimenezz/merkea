<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostalCoverage as ModelsPostalCoverage;

class PostalCoverageApi extends Controller
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
            $exist = ModelsPostalCoverage::where('PostalCode', $request->input('postal_code'))->first();
            if (!$exist) {

                $pc = ModelsPostalCoverage::create([
                    'UserId' => auth()->user()->id,
                    'StateId' => $request->input('state'),
                    'BranchId' => $request->input('branch'),
                    'City' => $request->input('city'),
                    'Colony' => $request->input('colony'),
                    'PostalCode' => $request->input('postal_code'),
                    'IsActive' => true
                ]);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('The postal code was saved successfully')
                ]);
            } else {
                return $this->jsonResponse(400, __('The postal code already exists'));
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
            return $this->jsonResponse(200, 'Loaded', ['postal_code' => ModelsPostalCoverage::findOrFail($id)]);
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
            $exist = ModelsPostalCoverage::where('PostalCode', $request->input('postal_code'))
                ->where('Id', "<>", $id)->first();
            if (!$exist) {
                $pc = ModelsPostalCoverage::findOrFail($id);

                $arrayUpdate = [
                    'UserId' => auth()->user()->id,
                    'StateId' => $request->input('state'),
                    'BranchId' => $request->input('branch'),
                    'City' => $request->input('city'),
                    'Colony' => $request->input('colony'),
                    'PostalCode' => $request->input('postal_code'),
                    'IsActive' => $request->input('active')
                ];

                $pc->update($arrayUpdate);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('The postal code was updated successfully')
                ]);
            } else {
                return $this->jsonResponse(400, __('The postal code already exists'));
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
