@extends('layouts.store.main')

@section('header')
    @component('components.store.header', ['categories' => $categories])
        @slot('show_search', true)
        @slot('show_menu', true)
    @endcomponent
@endsection

@section('content')
    @include('layouts.store.breadcrumb', ['breadcrumbs' => $breadcrumbs]);
    @include('layouts.store.deparment.main', ['products' => $products])
@endsection

@section('modules_js')
    <script type="module" src="{{ asset('assets/modules/store/grid_result.js') }}"></script>
@endsection

@section('footer')
    @guest
    @else
        @component('components.store.footer', ['categories' => $categories])
        @endcomponent
    @endguest
@endsection

@section('whatsapp')
    @guest
    @else
        <a target="_blank" id="btn-wa" href="https://wa.me/+525510562027">
            <img src="/store/img/whatsapp.svg" width="35px"></noscript><strong style="color:white;"></strong></a>
    @endguest
@endsection
