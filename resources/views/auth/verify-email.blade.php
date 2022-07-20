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
        <div class="row justify-content-center mt-50 mb-50">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex flex-row-fluid flex-column flex-column-fluid text-center p-10 py-lg-20">
                            <h1 class="fw-bolder fs-4 mb-7">{{ __('Verify Your Email') }}</h1>
                            <div class="fs-5 fw-bold text-muted mb-10 mt-20">
                                {{ __('We have sent you an email. Please follow the link to verify your account') }}</div>
                            <div class="text-center my-4">
                                <svg width="150" aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="envelopes-bulk" class="svg-inline--fa fa-envelopes-bulk fa-w-20"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M191.9 448.6c-9.766 0-19.48-2.969-27.78-8.891L32 340.2V480c0 17.62 14.38 32 32 32h256c17.62 0 32-14.38 32-32v-139.8L220.2 439.5C211.7 445.6 201.8 448.6 191.9 448.6zM320 256H64C46.38 256 32 270.4 32 288v12.18l151 113.8c5.25 3.719 12.7 3.734 18.27-.25L352 300.2V288C352 270.4 337.6 256 320 256zM480 224v64h64V224H480z"
                                            fill="currentColor" />
                                        <path class="fa-secondary"
                                            d="M192 192c0-35.25 28.75-64 64-64h224V32c0-17.62-14.38-32-32-32H128C110.4 0 96 14.38 96 32v192h96V192zM576 160H256C238.4 160 224 174.4 224 192v32h96c33.25 0 60.63 25.38 63.75 57.88L384 416h192c17.62 0 32-14.38 32-32V192C608 174.4 593.6 160 576 160zM544 288h-64V224h64V288zM183 413.9L32 300.2v40.06l132.1 99.51c8.297 5.922 18.02 8.891 27.78 8.891c9.859 0 19.78-3.031 28.33-9.141L352 340.2V300.2l-150.7 113.5C195.7 417.7 188.3 417.7 183 413.9z"
                                            fill="currentColor" />
                                    </g>
                                </svg>
                            </div>
                            <div class="fs-5 mb-5 mt-20">
                                <span class="fw-bold text-gray-700">{{ __("Didn't receive an email?") }}</span>
                                <form method="POST" class="load_on_submit" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link fw-bold">{{ __('Resend') }}</button>
                                </form>
                            </div>
                            @if (session('status') == 'verification-link-sent')
                                <div class="fw-bolder fs-5 text-danger mt-50">
                                    {{ __('A new verification link has been sent to the email address you provided during registration') }}
                                </div>
                            @endif
                        </div>
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
