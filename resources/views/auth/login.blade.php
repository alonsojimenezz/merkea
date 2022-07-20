@extends('layouts.store.main')

@section('header')
    @component('components.store.header',
        ['categories' => $categories, 'branches' => $branches, 'branch_info' => $branch_info])
        @slot('show_search', true)
        @slot('show_menu', true)
    @endcomponent
@endsection

@section('content')
    @include('layouts.store.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0">
                    <div class="card-body">
                        <form class="load_on_submit form w-100 fv-plugins-bootstrap5 fv-plugins-framework" method="POST"
                            action="{{ route('login') }}">
                            @csrf

                            @if (session('status'))
                                <div class="d-flex fw-bolder fs-6 text-danger justify-content-center mb-20">
                                    <span class="text-center">
                                        {{ session('status') }}
                                    </span>
                                </div>
                            @endif

                            <div class="text-center mb-10">
                                <h1 class="fs-4 mb-3">{{ __('Login Merkea Mini Market') }}</h1>
                                <div class="text-gray-400 fw-bold fs-6">{{ __('New here?') }}
                                    <a href="{{ route('register') }}"
                                        class="link-primary fw-bolder">{{ __('Create an Account') }}</a>
                                </div>
                            </div>
                            <div class="fv-row mb-10 fv-plugins-icon-container mt-20">
                                <label class="form-label fs-6 fw-bolder">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="fv-row mb-5 fv-plugins-icon-container mt-40">
                                <div class="d-flex flex-row mb-2">
                                    <div>
                                        <label class="form-label fw-bolder fs-6 mb-0">{{ __('Password') }}</label>
                                    </div>
                                    <div class="flex-grow-1 text-end">
                                        <a href="{{ route('password.request') }}"
                                            class="link-primary fs-7 fw-bolder">{{ __('Forgot password?') }}</a>
                                    </div>
                                </div>

                                <input id="password" type="password"
                                    class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex flex-row justify-content-end mb-8 fv-row fv-plugins-icon-container mt-15">
                                <div class="form-check text-end flew-grow-1">
                                    <label class="form-check-label fs-6" for="remember">
                                        {{ __('Remember me') }}
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="text-center mt-20">
                                <button type="submit" class="btn button_mkea w-100 mb-5 border-0 text-white">
                                    {{ __('Sign In') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.store.home_page.back_to_top_area')
@endsection

@section('footer')
    @component('components.store.footer', ['categories' => $categories, 'branch_info' => $branch_info])
    @endcomponent
@endsection

@section('whatsapp')
    <a target="_blank" id="btn-wa"
        href="https://wa.me/+52{{ preg_replace('/[^0-9]/', '', $branch_info->Phone ?? '') }}">
        <img src="{{ asset('store/img/whatsapp.svg') }}" width="35px"></noscript><strong
            style="color:white;"></strong></a>
@endsection
