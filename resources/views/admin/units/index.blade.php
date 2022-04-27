@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', 'Units of Measure')
        @slot('module', 'Catalogs')
        @slot('section', 'Units of Measure')
    @endcomponent
@endsection

@section('module')
    @component('components.javascript_module')
        @slot('module', 'admin/units')
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
                            <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="ruler"
                                class="svg-inline--fa fa-ruler fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <defs>
                                    <style>
                                        .fa-secondary {
                                            opacity: .4
                                        }

                                    </style>
                                </defs>
                                <g class="fa-group">
                                    <path class="fa-primary"
                                        d="M86.29 267.3L63.67 289.9l56.57 56.57c3.111 3.111 7.212 4.672 11.31 4.672c9.06 0 15.99-7.32 15.99-15.99c0-4.101-1.561-8.203-4.673-11.31L86.29 267.3zM154.2 199.4L131.5 222.1l56.57 56.57c3.11 3.111 7.212 4.673 11.31 4.673c8.687 0 15.99-6.956 15.99-15.99c0-4.101-1.562-8.203-4.672-11.31L154.2 199.4zM351.2 131.5c0-4.101-1.561-8.203-4.673-11.31l-56.57-56.57l-22.63 22.63l56.57 56.57c3.111 3.111 7.212 4.672 11.31 4.672C344.3 147.5 351.2 140.2 351.2 131.5zM222.1 131.5L199.4 154.2L256 210.7c3.112 3.111 7.213 4.672 11.31 4.672c9.059 0 15.99-7.324 15.99-15.99c0-4.102-1.562-8.203-4.673-11.31L222.1 131.5z"
                                        fill="currentColor" />
                                    <path class="fa-secondary"
                                        d="M512 145.1c0 8.202-3.111 16.4-9.334 22.63L167.7 502.7C161.5 508.9 153.3 512 145.1 512s-16.41-3.111-22.63-9.334L9.334 389.5C3.111 383.3 0 375.1 0 366.9s3.111-16.4 9.334-22.63l54.33-54.33l56.57 56.57c3.111 3.111 7.212 4.672 11.31 4.672c9.06 0 15.99-7.32 15.99-15.99c0-4.101-1.561-8.203-4.673-11.31L86.29 267.3l45.25-45.26l56.57 56.57c3.11 3.111 7.212 4.673 11.31 4.673c8.687 0 15.99-6.956 15.99-15.99c0-4.101-1.562-8.203-4.672-11.31L154.2 199.4l45.25-45.26L256 210.7c3.112 3.111 7.213 4.672 11.31 4.672c9.059 0 15.99-7.324 15.99-15.99c0-4.102-1.562-8.203-4.673-11.31l-56.57-56.57l45.26-45.25l56.57 56.57c3.111 3.111 7.212 4.672 11.31 4.672c9.06 0 15.99-7.32 15.99-15.99c0-4.101-1.561-8.203-4.673-11.31l-56.57-56.57l54.33-54.33c6.223-6.223 14.43-9.334 22.63-9.334s16.4 3.111 22.63 9.334l113.1 113.1C508.9 128.7 512 136.9 512 145.1z"
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
                                        class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{ __('Units of Measure') }}</a>
                                </div>
                                <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">
                                    {{ __('Manage your product units of measure') }}</div>
                            </div>
                            @can('Add Units of measure')
                                <div class="d-flex mb-4">
                                    <a href="#" id="show_new_unit_form"
                                        class="btn btn-primary">{{ __('New Unit of Measure') }}</a>
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
                            <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="magnifying-glass"
                                class="svg-inline--fa fa-magnifying-glass fa-w-16" role="img"
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
                    @can('Export Units of measure')
                        <div id="export-buttons-hiden" class="d-none"></div>
                    @endcan
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    @can('Export Units of measure')
                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <span class="svg-icon">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="down-to-line"
                                    class="svg-inline--fa fa-down-to-line fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 384 512">
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
                <table id="product_units_table"
                    class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                        <tr>
                            <th class="min-w-100px">{{ __('ID') }}</th>
                            <th class="min-w-200px">{{ __('Unit') }}</th>
                            <th class="min-w-200px">{{ __('Symbol') }}</th>
                            <th class="min-w-150px">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="fs-6">
                        @isset($units)
                            @foreach ($units as $unit)
                                @component('components.admin.units.unit_row')
                                    @slot('unit', $unit)
                                @endcomponent
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @can('Add Units of measure')
        @component('components.admin.modal')
            @slot('modal_id', 'modal_new_unit')
            @slot('title', __('New Unit of Measure'))
            @slot('subtitle', __('Create a new unit of measure for your products'))
            @slot('alt_title', __('Edit Unit of Measure'))
            @slot('alt_subtitle',
                __('Edit the unit or measure of your products') .
                '. ' .
                __('Remember that this change affects all
                associated products'),)
                @slot('body')
                    @include('admin.units.form_new_unit')
                @endslot
            @endcomponent
        @endcan
    @endsection
