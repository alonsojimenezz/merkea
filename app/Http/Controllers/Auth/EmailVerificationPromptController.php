<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\ProductCategories as ModelsProductCategories;
use App\Models\BranchOffices as ModelsBranchOffices;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $viewArray = [
            'categories' => ModelsProductCategories::getActivesTree(session('branch')),
            'branches' => ModelsBranchOffices::getActives(),
            'branch' => session('branch'),
            'branch_info' => ModelsBranchOffices::where('Id', session('branch'))->first(),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => [
                    'text' => __('Register'),
                    'url' => route('register'),
                ]
            ]
        ];

        return $request->user()->hasVerifiedEmail()
                    ? redirect()->route('store.account')
                    : view('auth.verify-email', $viewArray);
    }
}
