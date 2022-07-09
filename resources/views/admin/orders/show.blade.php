@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', __('Order') . ' ' . MUtils::fullOrderNumber($order->Id))
        @slot('module', 'Operations')
        @slot('route_section', route('admin.orders'))
        @slot('section', 'Orders')
        @slot('subsection', __('Order') . ' ' . MUtils::fullOrderNumber($order->Id))
    @endcomponent
@endsection

@section('module')
    @component('components.javascript_module')
        @slot('module', 'admin/order')
    @endcomponent
@endsection

@section('content')
    <div class="post fs-6 d-flex flex-column-fluid" id="">
        <div class="container-xxl">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                @include('admin.orders.tabs_order')
                @include('admin.orders.order_details')
                <div class="tab-content">
                    @include('admin.orders.order_summary')
                    @include('admin.orders.order_history')
                </div>
            </div>
        </div>
    </div>
@endsection

@can('Edit Order')
    @component('components.admin.modal')
        @slot('modal_id', 'modal_edit_product')
        @slot('title', __('Modify Product'))
        @slot('subtitle', __('Modify the product quantity or delete the product from the order'))
        @slot('body')
            @include('admin.orders.edit_product_form')
        @endslot
    @endcomponent

    @component('components.admin.modal')
        @slot('modal_id', 'modal_add_product')
        @slot('title', __('Add Product to Order'))
        @slot('subtitle', __('Did the customer forget any product?'))
        @slot('body')
            @include('admin.orders.add_product_form', ['order' => $order])
        @endslot
    @endcomponent
@endcan
