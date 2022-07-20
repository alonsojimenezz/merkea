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
                            action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">


                            <div class="text-center mb-10">
                                <h1 class="fs-4 mb-3">{{ __('Reset password') }}</h1>
                                <div class="fw-bold fs-6">{{ __('Chose a secure password') }}
                                </div>
                            </div>
                            <div class="fv-row mb-6 fv-plugins-icon-container mt-30">
                                <label class="form-label fs-6 fw-bolder">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $request->email) }}" required autocomplete="off"
                                    autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="fv-row mb-10 fv-plugins-icon-container mt-30">
                                <label class="form-label fs-6 fw-bolder">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="fv-row mb-10 fv-plugins-icon-container mt-30">
                                <label class="form-label fs-6 fw-bolder">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" type="password"
                                    class="form-control form-control-lg form-control-solid" name="password_confirmation"
                                    required autocomplete="new-password">
                            </div>

                            <div class="text-center mt-40">
                                <button type="submit" class="btn button_mkea w-100 mb-5 border-0 text-white">
                                    {{ __('Reset') }}
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
