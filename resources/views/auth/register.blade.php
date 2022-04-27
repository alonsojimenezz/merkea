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
                        <form method="POST" action="{{ route('register') }}"
                            class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework">
                            @csrf

                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-3">{{ __('Create An Account') }}</h1>
                                <div class="text-gray-400 fw-bold fs-4">{{ __('Already have an account?') }}
                                    <a href="{{ route('login') }}"
                                        class="link-primary fw-bolder">{{ __('Sign in here') }}</a>
                                </div>
                            </div>

                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <label class="form-label fs-6 fw-bolder text-dark">{{ __('Nombre') }}</label>
                                <input id="name" type="text"
                                    class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <label class="form-label fs-6 fw-bolder text-dark">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <label class="form-label fs-6 fw-bolder text-dark">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password"
                                    class="form-control form-control-lg form-control-solid" name="password_confirmation"
                                    required autocomplete="new-password">
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">{{ __('Sign up') }}</span>
                                    <span class="indicator-progress">{{ __('Wait') }} ...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
