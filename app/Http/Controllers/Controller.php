<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\BranchOffices as ModelsBranchOffices;
use App\Models\PostalCoverage as ModelsPostalCoverage;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $branches = ModelsBranchOffices::getActives();
        $postal_codes = ModelsPostalCoverage::getActives();
        View::share('branches_global', $branches);
        View::share('postal_codes_global', $postal_codes);
    }

    public function jsonResponse($code, $message, $body = [])
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'body' => $body,
        ]);
    }
}
