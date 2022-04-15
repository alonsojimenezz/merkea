@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" method="POST"
                            action="{{ route('password.email') }}">
                            @csrf

                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-3">{{ __('Forgot password?') }}</h1>
                                <div class="text-gray-400 fw-bold fs-4">{{ __('Enter your email to reset your password') }}
                                </div>
                            </div>
                            <div class="fv-row mb-6 fv-plugins-icon-container">
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
                            <div class="text-center mb-2">
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">{{ __('Send Reset Link') }}</span>
                                    <span class="indicator-progress">{{ __('Wait') }} ...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a class="underline text-sm text-gray-800 text-hover-primary" href="{{ route('login') }}">
                                    {{ __('Go Back') }}
                                </a>
                            </div>

                            @if (session('status'))
                                <div class="d-flex fw-bolder fs-4 text-gray-700 justify-content-center mt-4">
                                    <span class="text-center">
                                    {{ session('status') }}
                                    </span>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
