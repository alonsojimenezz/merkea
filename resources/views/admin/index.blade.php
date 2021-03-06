@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', 'Administrator Panel - Initial Section')
        @slot('module', 'Inicio')
        @slot('section', 'Dashboard')
    @endcomponent
@endsection

@section('module')
    @component('components.javascript_module')
        @slot('module', 'admin/dashboard')
    @endcomponent
@endsection

@section('content')
    <div class="container-xxl">
        @include('admin.dashboard.content')
    </div>
@endsection
