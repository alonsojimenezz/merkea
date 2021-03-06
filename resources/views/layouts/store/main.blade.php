<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9TTNLF8V39"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-9TTNLF8V39');
    </script>

    <title>{{ config('app.name', 'Merkea') }}</title>
    <meta name="description" content="">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @include('layouts.favicon')

    <link href="{{ asset('store/css/app.css?v=1.1') }}" rel="stylesheet">
    @yield('app_css')
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <input type="hidden" id="branch_selected" value="{{ session('branch') ?? 0 }}" />

    @include('layouts.store.preloader')

    @include('layouts.store.back_to_top')

    @yield('header')

    @include('layouts.store.mobile_menu')

    <main>
        @yield('content')
    </main>

    @yield('footer')

    @component('components.admin.toast', ['position' => 'top-50 end-0 translate-middle-y'])
    @endcomponent

    @component('components.admin.modal')
        @slot('modal_id', 'modal_no_branch_selected')
        @slot('body')
            @include('store.modal_no_branch')
        @endslot
        @slot('no_close')
        @endcomponent

        <script src="{{ asset('js/store.js?v=1.0') }}"></script>
        @yield('modules_js')
        <script type="module" src="{{ asset('assets/modules/store/store.js?v=1.1') }}"></script>
    </body>
    @yield('whatsapp')

    </html>
