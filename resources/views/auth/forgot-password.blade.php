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
                        <form class="form load_on_submit w-100 fv-plugins-bootstrap5 fv-plugins-framework" method="POST"
                            action="{{ route('password.email') }}">
                            @csrf

                            <div class="text-center mb-10">
                                <h1 class="fs-4 mb-3">{{ __('Forgot password?') }}</h1>
                                <div class="my-5">
                                    <svg width="100" aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                        data-icon="lock-keyhole" class="svg-inline--fa fa-lock-keyhole fa-w-14"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <defs>
                                            <style>
                                                .fa-secondary {
                                                    opacity: .4
                                                }
                                            </style>
                                        </defs>
                                        <g class="fa-group">
                                            <path class="fa-primary"
                                                d="M0 287.1v160c0 35.34 28.65 64 64 64h320c35.35 0 64-28.66 64-64v-160c0-35.35-28.65-64-64-64H64C28.65 223.1 0 252.7 0 287.1zM192 351.1c0-17.67 14.33-32 32-32s32 14.33 32 32v32c0 17.67-14.33 32-32 32s-32-14.33-32-32V351.1z"
                                                fill="currentColor" />
                                            <path class="fa-secondary"
                                                d="M368 144V224h-64V144C304 99.88 268.1 64 224 64S144 99.88 144 144V224h-64V144c0-79.41 64.59-144 144-144S368 64.59 368 144z"
                                                fill="currentColor" />
                                        </g>
                                    </svg>
                                </div>
                                @if (session('status'))
                                    <div class="d-flex fw-bolder fs-6 text-danger justify-content-center mt-4">
                                        <span class="text-center">
                                            {{ session('status') }}
                                        </span>
                                    </div>
                                @endif
                                <div class="text-gray-400 fw-bold fs-6 mt-30">
                                    {{ __('Enter your email to reset your password') }}
                                </div>
                            </div>
                            <div class="fv-row mb-6 fv-plugins-icon-container mt-15">
                                <input id="email" type="email"
                                    class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center mb-2 mt-40">
                                <button type="submit" class="btn button_mkea w-100 mb-5 border-0 text-white">
                                    {{ __('Send Reset Link') }}
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
