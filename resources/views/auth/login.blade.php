@extends('layouts.store.main')

@section('app_css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('header')
    @component('components.store.header')
        @slot('show_search', false)
        @slot('show_menu', false)
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" method="POST"
                            action="{{ route('login') }}">
                            @csrf

                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-3">{{ __('Login Merkea Mini Market') }}</h1>
                                <div class="text-gray-400 fw-bold fs-4">{{ __('New here?') }}
                                    <a href="{{ route('register') }}"
                                        class="link-primary fw-bolder">{{ __('Create an Account') }}</a>
                                </div>
                            </div>
                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="fv-row mb-5 fv-plugins-icon-container">
                                <div class="d-flex flex-stack mb-2">
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                                    <a href="{{ route('password.request') }}"
                                        class="link-primary fs-6 fw-bolder">{{ __('Forgot password?') }}</a>
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
                            <div class="d-flex flex-row mb-8 fv-row fv-plugins-icon-container">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">{{ __('Sign In') }}</span>
                                    <span class="indicator-progress">{{ __('Wait') }} ...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <div class="d-flex flex-row justify-content-center" >
                                <a class="link-primary" href="{{ Route::has('store.index') ? route('store.index') : '/' }}">{{ __('Back to store') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
