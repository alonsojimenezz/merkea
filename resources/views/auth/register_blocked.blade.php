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
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">{{ __('Sign Up Blocked') }}</h1>
                            <div class="text-gray-400 fw-bold fs-4">
                                {{ __('We are sorry but the sign ups are blocked right now') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
