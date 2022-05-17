<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BranchOffices as ModelsBranchOffices;

class BranchOffices extends Controller
{
    public function index()
    {
        return view('admin.branch_offices.index', [
            'branches' => ModelsBranchOffices::all()
        ]);
    }
}
