<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts.favicon')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Merkea Mini Market') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-fixed aside-default-enabled">
    @include('layouts.loading')
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">

            @include('layouts.admin.menu')

            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                @include('layouts.admin.top_bar')

                <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('toolbar')
                    @yield('content')
                </div>
                @include('layouts.admin.footer')
            </div>
        </div>
    </div>

    @component('components.admin.toast')
    @endcomponent

    @include('layouts.admin.scroll_top')

    @include('layouts.admin.scripts')

    @yield('module')

</body>

</html>
