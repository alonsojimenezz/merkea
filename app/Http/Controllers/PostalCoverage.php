<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostalCoverage as ModelsPostalCoverage;
use App\Models\States as ModelsStates;

class PostalCoverage extends Controller
{
    public function index()
    {
        return view('admin.postal_coverage.index', [
            'codes' => ModelsPostalCoverage::getAll(),
            'states' => ModelsStates::all()
        ]);
    }
}
