<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\ProductCategories as ModelsProductCategories;
use App\Models\BranchOffices as ModelsBranchOffices;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
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
        return view('auth.register', $viewArray);
        //return view('auth.register_blocked');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
