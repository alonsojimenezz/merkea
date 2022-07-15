@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', __('Sales'))
        @slot('module', __('Reports'))
        @slot('section', __('Sales'))
    @endcomponent
@endsection

@section('module')
    @component('components.javascript_module')
        @slot('module', 'admin/dashboard')
    @endcomponent
@endsection

@section('content')
    <div class="container-xxl">
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <input class="form-control
                " placeholder="{{ __('Pick date range') }}"
                    id="daterange_report" />
            </div>
        </div>
        <div class="row g-5 g-lg-10">
            <div class="col-md-12 col-xl-12 mb-md-5 mb-xxl-10">
                <div class="card mb-5 mb-lg-10">
                    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                        <div class="mb-4 px-9">
                            <div class="d-flex align-items-center mb-2">
                                <span class="fs-4 fw-bold text-gray-400 align-self-start me-1>">$</span>
                                <span class="fs-2hx fw-bolder text-gray-800 me-2 lh-1" id="sales_total">0</span>
                            </div>
                            <span class="fs-6 fw-bold text-gray-400">{{ __('Total Online Sales') }}</span>
                        </div>
                        <div class="">
                            <div id="total_sales_g"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5 g-lg-10">
            <div class="col-md-12 col-xl-12 mb-md-5 mb-xxl-10">
                <div class="card mb-5 mb-lg-10">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h2 class="fs-2 fw-bold my-2">{{ __('Sales') }}
                                <span class="fs-6 text-gray-400 ms-1">{{ __('by branch office') }}</span>
                            </h2>
                            <div id="export-buttons-hiden" class="d-none"></div>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <span class="svg-icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                        data-icon="down-to-line" class="svg-inline--fa fa-down-to-line fa-w-12"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
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
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                        <div class="table-responsive px-4">
                            <table
                                class="table table-rounded border table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer"
                                id="total_sales_table">
                                <thead class="fs-7  text-uppercase text-black fw-bolder">
                                    <tr>
                                        <th class="text-center">{{ __('Day') }}</th>
                                        @foreach ($branches as $branch)
                                            <th class="text-center">{{ $branch->Name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5 g-lg-10">
            <div class="col-12 col-md-6">
                <div class="card mb-5 mb-lg-10">
                    <div class="card-header align-items-center gap-2 gap-md-5">
                        <div class="card-title">
                            <h2 class="fs-2 fw-bold my-2">{{ __('Sales') }}
                                <span class="fs-6 text-gray-400 ms-1">{{ __('by product') }}</span>
                            </h2>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between flex-column p-0">
                        <div class="px-4">
                            <div id="total_sales_products_g"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card mb-5 mb-lg-10">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h2 class="fs-2 fw-bold my-2">{{ __('Sales') }}
                                <span class="fs-6 text-gray-400 ms-1">{{ __('by product') }}</span>
                            </h2>
                            <div id="sales-by-product-export-buttons" class="d-none"></div>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <span class="svg-icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                        data-icon="down-to-line" class="svg-inline--fa fa-down-to-line fa-w-12"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
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
                            <div id="sbp_export_menu"
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
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                        <div class="table-responsive px-4">
                            <table
                                class="table table-rounded border table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer"
                                id="total_sales_product_table">
                                <thead class="fs-7  text-uppercase text-black fw-bolder">
                                    <tr>
                                        <th class="text-center">{{ __('Prooduct') }}</th>
                                        <th class="text-center">{{ __('Total') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5 g-lg-10">
            <div class="col-12 col-md-6">
                <div class="card mb-5 mb-lg-10">
                    <div class="card-header align-items-center gap-2 gap-md-5">
                        <div class="card-title">
                            <h2 class="fs-2 fw-bold my-2">{{ __('Sales') }}
                                <span class="fs-6 text-gray-400 ms-1">{{ __('by department') }}</span>
                            </h2>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between flex-column p-0">
                        <div class="px-4">
                            <div id="total_sales_department_g"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card mb-5 mb-lg-10">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h2 class="fs-2 fw-bold my-2">{{ __('Sales') }}
                                <span class="fs-6 text-gray-400 ms-1">{{ __('by department') }}</span>
                            </h2>
                            <div id="sales-by-department-export-buttons" class="d-none"></div>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <span class="svg-icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                        data-icon="down-to-line" class="svg-inline--fa fa-down-to-line fa-w-12"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
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
                            <div id="sbd_export_menu"
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
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                        <div class="table-responsive px-4">
                            <table
                                class="table table-rounded border table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer"
                                id="total_sales_department_table">
                                <thead class="fs-7  text-uppercase text-black fw-bolder">
                                    <tr>
                                        <th class="text-center">{{ __('Department') }}</th>
                                        <th class="text-center">{{ __('Total') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
