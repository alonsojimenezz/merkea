<?php

namespace App\Http\Controllers;

use App\Models\Units as ModelsUnits;
use Illuminate\Http\Request;

class Units extends Controller
{
    public function index()
    {
        return view('admin.units.index', [
            'units' => ModelsUnits::orderBy('Name')->get()
        ]);
    }
}
