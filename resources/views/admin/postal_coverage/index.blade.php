@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', 'Postal Code Coverage')
        @slot('module', 'Catalogs')
        @slot('section', 'Postal Code Coverage')
    @endcomponent
@endsection

@section('module')
    @component('components.javascript_module')
        @slot('module', 'admin/postal_codes')
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
                            <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="envelopes-bulk"
                                class="svg-inline--fa fa-envelopes-bulk fa-w-20" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <defs>
                                    <style>
                                        .fa-secondary {
                                            opacity: .4
                                        }

                                    </style>
                                </defs>
                                <g class="fa-group">
                                    <path class="fa-primary"
                                        d="M191.9 448.6c-9.766 0-19.48-2.969-27.78-8.891L32 340.2V480c0 17.62 14.38 32 32 32h256c17.62 0 32-14.38 32-32v-139.8L220.2 439.5C211.7 445.6 201.8 448.6 191.9 448.6zM320 256H64C46.38 256 32 270.4 32 288v12.18l151 113.8c5.25 3.719 12.7 3.734 18.27-.25L352 300.2V288C352 270.4 337.6 256 320 256zM480 224v64h64V224H480z"
                                        fill="currentColor" />
                                    <path class="fa-secondary"
                                        d="M192 192c0-35.25 28.75-64 64-64h224V32c0-17.62-14.38-32-32-32H128C110.4 0 96 14.38 96 32v192h96V192zM576 160H256C238.4 160 224 174.4 224 192v32h96c33.25 0 60.63 25.38 63.75 57.88L384 416h192c17.62 0 32-14.38 32-32V192C608 174.4 593.6 160 576 160zM544 288h-64V224h64V288zM183 413.9L32 300.2v40.06l132.1 99.51c8.297 5.922 18.02 8.891 27.78 8.891c9.859 0 19.78-3.031 28.33-9.141L352 340.2V300.2l-150.7 113.5C195.7 417.7 188.3 417.7 183 413.9z"
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
                                        class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{ __('Postal Code Coverage') }}</a>
                                </div>
                                <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">
                                    {{ __('Manage your postal code coverage') }}</div>
                            </div>
                            @can('Add Postal Code Coverage')
                                <div class="d-flex mb-4">
                                    <a href="#" id="show_new_postal_code_form"
                                        class="btn btn-primary">{{ __('New Postal Code') }}</a>
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
                    @can('Export Postal Code Coverage')
                        <div id="export-buttons-hiden" class="d-none"></div>
                    @endcan
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    @can('Export Postal Code Coverage')
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
                <table id="postal_codes_table"
                    class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                        <tr>
                            <th class="min-w-100px">{{ __('ID') }}</th>
                            <th class="min-w-100px">{{ __('Postal Code') }}</th>
                            <th class="min-w-125px">{{ __('State') }}</th>
                            <th class="min-w-150px">{{ __('City') }}</th>
                            <th class="min-w-150px">{{ __('Colony') }}</th>
                            <th class="min-w-150px">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="fs-6">
                        @isset($codes)
                            @foreach ($codes as $code)
                                @component('components.admin.postal_codes.code_row')
                                    @slot('code', $code)
                                @endcomponent
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @can('Add Postal Code Coverage')
        @component('components.admin.modal')
            @slot('modal_id', 'modal_new_postal_code')
            @slot('title', __('New Postal Code'))
            @slot('subtitle', __('Define a new postal code for coverage'))
            @slot('alt_title', __('Edit Postal Code'))
            @slot('alt_subtitle', __('Edit the postal code info') . '. ')
            @slot('body')
                @include('admin.postal_coverage.form_new_code')
            @endslot
        @endcomponent
    @endcan
@endsection
