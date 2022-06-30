    @extends('layouts.admin.main')

    @section('toolbar')
        @component('components.toolbar')
            @slot('title', 'Products')
            @slot('module', 'Catalogs')
            @slot('section', 'Products')
        @endcomponent
    @endsection

    @section('module')
        @component('components.javascript_module')
            @slot('module', 'admin/products')
        @endcomponent
    @endsection

    @section('content')
        <div class="container-xxl">
            <div class="card">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <div
                            class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4 text-mkea-primary">
                            <span class="svg-icon svg-icon-4x text-primary">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="wine-bottle"
                                    class="svg-inline--fa fa-wine-bottle fa-w-16" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }

                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M417.9 161.9l-32.53 32.53c19.75 46.63 10.75 102.4-27.25 140.4l-158.4 158.4c-25 25-65.51 25-90.51 0l-90.51-90.52c-25-25-25-65.51 0-90.51l24.75-24.75l135.8 135.8l122-122L165.5 165.5l11.63-11.63c38-38 93.76-47 140.4-27.25l32.53-32.53L417.9 161.9z"
                                            fill="currentColor" />
                                        <path class="fa-secondary"
                                            d="M179.3 423.2L43.5 287.5l122-122l135.8 135.8L179.3 423.2zM507.3 72.57l-67.88-67.88c-6.252-6.25-16.38-6.25-22.63 0l-22.63 22.62c-6.248 6.252-6.245 16.38-.0006 22.63c.002 .002-.002-.002 0 0L350.1 94.05l67.88 67.88l44.11-44.11c6.254 6.25 16.5 6.25 22.75 0l22.63-22.63C513.5 88.95 513.5 78.82 507.3 72.57z"
                                            fill="currentColor" />
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-1">
                                        <a
                                            class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{ __('Products') }}</a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">
                                        {{ __('Manage your products') }}</div>
                                </div>
                                @can('Add Products')
                                    <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                                        {{-- <a href="#" class="btn btn-outline btn-outline-dashed btn-outline-warning btn-active-warning fw-bolder me-4"
                                            data-bs-toggle="modal" data-bs-target="#modal_upload_inventory">{{__('Upload Inventory')}}</a> --}}
                                        <a href="#" id="show_new_product_form"
                                            class="btn btn-primary">{{ __('New Product') }}</a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-10">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon position-absolute ms-4">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="magnifying-glass" class="svg-inline--fa fa-magnifying-glass fa-w-16"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }

                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M500.3 443.7l-119.7-119.7c-15.03 22.3-34.26 41.54-56.57 56.57l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7z"
                                            fill="currentColor" />
                                        <path class="fa-secondary"
                                            d="M207.1 0C93.12 0-.0002 93.13-.0002 208S93.12 416 207.1 416s208-93.13 208-208S322.9 0 207.1 0zM207.1 336c-70.58 0-128-57.42-128-128c0-70.58 57.42-128 128-128s128 57.42 128 128C335.1 278.6 278.6 336 207.1 336z"
                                            fill="currentColor" />
                                    </g>
                                </svg>
                            </span>
                            <input type="text" dt-filter="search" class="form-control form-control-solid w-250px ps-15"
                                placeholder="{{ __('Filter table') }}">
                        </div>
                        @can('Export Products')
                            <div id="export-buttons-hiden" class="d-none"></div>
                        @endcan
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        @can('Export Products')
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <span class="svg-icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="down-to-line"
                                        class="svg-inline--fa fa-down-to-line fa-w-12" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                        <defs>
                                            <style>
                                                .fa-secondary {
                                                    opacity: .4
                                                }

                                            </style>
                                        </defs>
                                        <g class="fa-group">
                                            <path class="fa-primary"
                                                d="M350 206.6c3.781 8.803 1.984 19.03-4.594 26l-136 144.1c-9.062 9.601-25.84 9.601-34.91 0l-136-144.1C31.97 225.7 30.17 215.4 33.95 206.6C37.75 197.8 46.42 192.1 56 192.1L128 192.1V64.03c0-17.69 14.33-32.02 32-32.02h64c17.67 0 32 14.34 32 32.02v128.1l72 .0314C337.6 192.1 346.3 197.8 350 206.6z"
                                                fill="currentColor" />
                                            <path class="fa-secondary"
                                                d="M352 416H31.1C14.33 416 0 430.3 0 447.1S14.33 480 31.1 480H352C369.7 480 384 465.7 384 448S369.7 416 352 416z"
                                                fill="currentColor" />
                                        </g>
                                    </svg>
                                </span>
                                {{ __('Export') }}
                            </button>
                            <div id="export_menu"
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                                data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-export="copy">
                                        {{ __('Copy to clipboard') }}
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-export="excel">
                                        {{ __('Export to Excel') }}
                                    </a>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table id="products_table"
                        class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer">
                        <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr>
                                <th class="min-w-70px">{{ __('ID') }}</th>
                                <th class="min-w-200px">{{ __('Key') }}</th>
                                <th class="min-w-250px">{{ __('Product') }}</th>
                                <th class="min-w-200px">{{ __('Department') }}</th>
                                <th class="min-w-200px">{{ __('Category') }}</th>
                                <th class="min-w-150px">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @isset($products)
                                @foreach ($products as $product)
                                    @component('components.admin.products.product_row')
                                        @slot('product', $product)
                                    @endcomponent
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @can('Add Products')
            @component('components.admin.modal')
                @slot('modal_id', 'modal_new_product')
                @slot('title', __('New Product'))
                @slot('subtitle', __('Create a new product, please fill the form below'))
                @slot('body')
                    @include('admin.products.form_new_product')
                @endslot
            @endcomponent

            {{-- @component('components.admin.modal')
                @slot('modal_id', 'modal_upload_inventory')
                @slot('title', __('Upload Inventory'))
                @slot('subtitle', __('To upload new inventory, select the branch office and look for the inventory format on your device'))
                @slot('body')
                    @include('admin.products.form_upload_inventory', ['branches' => $branches])
                @endslot
            @endcomponent --}}
        @endcan
    @endsection
