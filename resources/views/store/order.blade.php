@extends('layouts.store.main')

@section('header')
    @component('components.store.header', ['categories' => $categories, 'branches' => $branches, 'branch_info' => $branch_info])
        @slot('show_search', true)
        @slot('show_menu', true)
    @endcomponent
@endsection

@section('content')
    @include('layouts.store.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    @include('layouts.store.order')
    @include('layouts.store.home_page.back_to_top_area')
@endsection

@section('modules_js')
    <script type="module" src="{{ asset('assets/modules/store/checkout.js') }}"></script>
@endsection

@section('footer')
    @component('components.store.footer', ['categories' => $categories, 'branch_info' => $branch_info])
    @endcomponent
@endsection

@section('whatsapp')
    <a target="_blank" id="btn-wa" href="https://wa.me/+52{{ preg_replace('/[^0-9]/', '', $branch_info->Phone ?? '') }}">
        <img src="{{ asset('store/img/whatsapp.svg') }}" width="35px"></noscript><strong style="color:white;"></strong></a>
@endsection

