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
    <div class="container mt-30 mb-50">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0">
                    <div class="card-body">
                        <form id="register_form" class="load_on_submit" method="POST" action="{{ route('register') }}"
                            class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework">
                            @csrf
                            <div class="text-center mb-10">
                                <h1 class="mb-3 fs-5">{{ __('Create An Account') }}</h1>
                                <div class="text-gray-400 fw-bold fs-6">{{ __('Already have an account?') }}
                                    <a href="{{ route('login') }}"
                                        class="link-primary fw-bolder">{{ __('Sign in here') }}</a>
                                </div>
                            </div>

                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <label class="form-label fs-6 fw-bolder ">{{ __('Nombre') }}</label>
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
                                <label class="form-label fs-6 fw-bolder ">{{ __('Email') }}</label>
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
                                <label class="form-label fs-6 fw-bolder ">{{ __('Password') }}</label>
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
                                <label class="form-label fs-6 fw-bolder ">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password"
                                    class="form-control form-control-lg form-control-solid" name="password_confirmation"
                                    required autocomplete="new-password">
                            </div>

                            <div class="text-center mt-25">
                                <button id="register_button" type="submit" class="btn button_mkea w-100 mb-5 border-0 text-white">
                                    {{ __('Sign up') }}
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
