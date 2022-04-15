@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', 'Products')
        @slot('module', 'Catalogs')
        @slot('section', 'Products')
    @endcomponent
@endsection

@section('content')
    {{ __('Here goes Products table') }}
@endsection
