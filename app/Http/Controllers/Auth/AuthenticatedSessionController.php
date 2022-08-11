<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\ProductCategories as ModelsProductCategories;
use App\Models\BranchOffices as ModelsBranchOffices;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
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
                    'text' => __('Login'),
                    'url' => route('login'),
                ]
            ],
            'redirect' => $request->has('redirect') ? $request->input('redirect') : '',
        ];
        return view('auth.login', $viewArray);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $cart = session('cart');
        $request->session()->regenerate();
        session()->put('cart', $cart);
        return redirect()->route('verification.notice', ['redirect' => request()->input('redirect') ?? '']);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $branch = session('branch');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->put('branch', $branch);

        return redirect('/');
    }
}
