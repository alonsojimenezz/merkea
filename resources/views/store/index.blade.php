@extends('layouts.store.main')

@section('header')
    @component('components.store.header')
        @guest
            @slot('show_search', false)
        @else
            @slot('show_search', true)
        @endguest
        @guest
            @slot('show_menu', false)
        @else
            @slot('show_menu', true)
        @endguest
    @endcomponent
@endsection

@section('content')
    @guest
        <div class="flex flex-column justify-content-center align-items-center min-vh-90">
            <div class="col text-center align-self-center">
                <img src="{{ asset('store/img/logo/logo.svg') }}" style="max-height:100px; margin-top:30vh" alt="">
            </div>
        </div>
    @else
        @include('layouts.store.home_page.slider_area')
        @include('layouts.store.home_page.features_area')
        @include('layouts.store.home_page.onsale_product_area')
        @include('layouts.store.home_page.banner_area')
        @include('layouts.store.home_page.back_to_top_area')
    @endguest
@endsection

@section('footer')
    @guest
    @else
        @component('components.store.footer')
        @endcomponent
    @endguest
@endsection

@section('whatsapp')
    @guest
    @else
        <a target="_blank" id="btn-wa" href="https://wa.me/+525510562027">
            <img src="store/img/whatsapp.svg" width="35px"></noscript><strong style="color:white;">Escríbenos un
                Whatsapp</strong></a>
    @endguest
@endsection
