@extends('layouts.store.main')

@section('header')
    @component('components.store.header', ['categories' => $categories, 'branches' => $branches, 'bid' => $branch])
        @slot('show_search', true)
        @slot('show_menu', true)
    @endcomponent
@endsection

@section('content')
    @include('layouts.store.breadcrumb', ['breadcrumbs' => $breadcrumbs]);
    @include('layouts.store.product.details', ['product' => $product])
@endsection

@section('modules_js')
    <script type="module" src="{{ asset('assets/modules/store/product.js') }}"></script>
@endsection

@section('footer')
    @component('components.store.footer', ['categories' => $categories])
    @endcomponent
@endsection

@section('whatsapp')
    <a target="_blank" id="btn-wa" href="https://wa.me/+525510562027">
        <img src="/store/img/whatsapp.svg" width="35px"></noscript><strong style="color:white;"></strong></a>
@endsection
