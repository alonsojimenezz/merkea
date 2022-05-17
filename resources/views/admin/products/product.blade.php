@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', $product->Name)
        @slot('module', 'Catalogs')
        @slot('section', 'Products')
        @slot('route_section', route('admin.products'))
        @slot('subsection', $product->Name ?? __('Unknown Product'))
    @endcomponent
@endsection

@section('module')
    @component('components.javascript_module')
        @slot('module', 'admin/show_product')
    @endcomponent
@endsection

@section('content')
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Form-->
            <div class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
                @include('admin.products.aside_product', ['product' => $product])
                @include('admin.products.main_content', ['product' => $product])
                <div></div>
            </div>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
@endsection
