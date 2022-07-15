<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BranchOffices as ModelsBranchOffices;

class Dashboard extends Controller
{
    public function index()
    {
        $activeBranches = ModelsBranchOffices::where('IsActive', 1)->get();
        return view('admin.dashboard.index',[
            'branches' => $activeBranches
        ]);
    }
}
