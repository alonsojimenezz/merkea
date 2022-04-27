<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class Staff extends Controller
{
    public function index()
    {
        return view('admin.staff.index', [
            'staffs' => User::with("roles")->whereHas("roles", function ($q) {
                $q->whereIn("name", ["Staff"]);
            })->get()
        ]);
    }

    public function view_staff($id)
    {
        return view('admin.staff.staff', [
            'permissions' => $this->get_permissions(Permission::all()),
            'logins' => LoginLog::where("user_id", $id)->orderBy('Id','desc')->limit(10)->get(),
            'staff' => User::with("roles")->whereHas("roles", function ($q) {
                $q->whereIn("name", ["Staff"]);
            })->find($id)
        ]);
    }

    private function get_permissions($permissions)
    {
        $permissions_array = [];

        foreach ($permissions as $permission) {
            if(!array_key_exists($permission->category, $permissions_array)) {
                $permissions_array[$permission->category] = [];
            }

            $permissions_array[$permission->category][] = $permission->name;
        }

        return $permissions_array;
    }
}
