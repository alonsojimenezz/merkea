@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex flex-row-fluid flex-column flex-column-fluid text-center p-10 py-lg-20">
                            <h1 class="fw-bolder fs-2qx text-gray-800 mb-7">{{ __('Verify Your Email') }}</h1>
                            <div class="fs-3 fw-bold text-muted mb-10">
                                {{ __('We have sent you an email. Please follow the link to verify your account') }}</div>
                            <div class="text-center mb-10">
                                <a href="/"
                                    class="btn btn-lg btn-primary fw-bolder">{{ __('Go back to Merkea Mini Market') }}</a>
                            </div>
                            <div class="fs-5 mb-5">
                                <span class="fw-bold text-gray-700">{{ __("Didn't receive an email?") }}</span>
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link fw-bold">{{ __('Resend') }}</button>
                                </form>
                            </div>
                            @if (session('status') == 'verification-link-sent')
                                <div class="fw-bolder fs-4 text-gray-700">
                                    {{ __('A new verification link has been sent to the email address you provided during registration') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
