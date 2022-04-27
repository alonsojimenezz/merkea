<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StaffApi extends Controller
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
            $exist = User::where('email', $request->input('email'))->first();
            if (!$exist) {

                $staff = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'email_verified_at' => now(),
                    'is_active' => true,
                ])->assignRole('Staff');

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('Staff was saved successfully'),
                    'staff' => $staff
                ]);
            } else {
                return $this->jsonResponse(400, __('Staff already exist'));
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
            return $this->jsonResponse(200, 'Loaded', ['staff' => User::findOrFail($id)]);
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
            $exist = User::where('email', $request->input('email'))
                ->where('Id', "<>", $id)->first();
            if (!$exist) {
                $staff = User::findOrFail($id);

                $arrayUpdate = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'is_active' => $request->input('active'),
                    'email_verified_at' => now()
                ];

                if($request->input('password') != null && $request->input('password') != ''){
                    $arrayUpdate['password'] = bcrypt($request->input('password'));
                }

                $staff->update($arrayUpdate);

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('Staff was saved successfully')
                ]);
            } else {
                return $this->jsonResponse(400, __('Staff email already exists'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermission(Request $request, $id)
    {
        try {
            $staff = User::find($id);
            if ($staff) {
                if ($request->input('value') == 1)
                    $staff->givePermissionTo($request->input('permission'));
                else
                    $staff->revokePermissionTo($request->input('permission'));

                return $this->jsonResponse(200, 'Saved', [
                    'alert' => __('Staff permission was update successfully')
                ]);
            } else {
                return $this->jsonResponse(400, __('Staff not found'));
            }
        } catch (\Exception $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
