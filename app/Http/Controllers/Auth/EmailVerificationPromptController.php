<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\ProductCategories as ModelsProductCategories;
use App\Models\BranchOffices as ModelsBranchOffices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request, $redirect = null)
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

        if ($request->user()->hasVerifiedEmail()) {
            if ($request->user()->hasRole('Administrator') || $request->user()->hasRole('Staff')) {
                return redirect()->route('admin.index');
            } else {
                if ($request->has('redirect')) {
                    if (Route::has($request->input('redirect'))) {
                        return redirect()->route($request->input('redirect'));
                    }
                }

                return redirect()->route('store.account');
            }
        } else {
            return view('auth.verification-prompt', $viewArray);
        }

        // return $request->user()->hasVerifiedEmail()
        //     ? redirect()->route('store.account')
        //     : view('auth.verify-email', $viewArray);
    }
}
