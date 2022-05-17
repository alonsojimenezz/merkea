<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\BranchOffices;
use Illuminate\Http\Request;

class BranchOfficesApi extends Controller
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
            $exist = BranchOffices::where('Name', $request->input('name'))->first();
            if (!$exist) {

                $staff = BranchOffices::create([
                    'Name' => $request->input('name'),
                    'Address' => $request->input('address'),
                    'Frame' => $request->input('frame'),
                    'IsActive' => 1
                ]);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('The Branch Office was saved successfully')
                ]);
            } else {
                return $this->jsonResponse(400, __('The branch office already exist'));
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
            return $this->jsonResponse(200, 'Loaded', ['branch_office' => BranchOffices::findOrFail($id)]);
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
            $exist = BranchOffices::where('Name', $request->input('name'))
                ->where('Id', "<>", $id)->first();
            if (!$exist) {
                $branch_office = BranchOffices::findOrFail($id);

                $arrayUpdate = [
                    'Name' => $request->input('name'),
                    'Address' => $request->input('address'),
                    'IsActive' => $request->input('active'),
                    'Frame' => $request->input('frame')
                ];

                $branch_office->update($arrayUpdate);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('The Branch Office was updated successfully')
                ]);
            } else {
                return $this->jsonResponse(400, __('The Branch Office already exist'));
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
