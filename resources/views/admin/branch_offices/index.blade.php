@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', 'Branch Offices')
        @slot('module', 'Catalogs')
        @slot('section', 'Branch Offices')
    @endcomponent
@endsection

@section('module')
    @component('components.javascript_module')
        @slot('module', 'admin/branch_offices')
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
                            <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="buildings"
                                class="svg-inline--fa fa-buildings fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
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
                                        d="M464 0h-224C213.5 0 192 21.49 192 48v463.1L480 512c17.67 0 32-14.33 32-32V48C512 21.49 490.5 0 464 0zM320 304c0 8.836-7.164 16-16 16h-32C263.2 320 256 312.8 256 304v-32C256 263.2 263.2 256 272 256h32C312.8 256 320 263.2 320 272V304zM320 208C320 216.8 312.8 224 304 224h-32C263.2 224 256 216.8 256 208v-32C256 167.2 263.2 160 272 160h32C312.8 160 320 167.2 320 176V208zM320 112C320 120.8 312.8 128 304 128h-32C263.2 128 256 120.8 256 112v-32C256 71.16 263.2 64 272 64h32C312.8 64 320 71.16 320 80V112zM448 304c0 8.836-7.164 16-16 16h-32C391.2 320 384 312.8 384 304v-32C384 263.2 391.2 256 400 256h32C440.8 256 448 263.2 448 272V304zM448 208C448 216.8 440.8 224 432 224h-32C391.2 224 384 216.8 384 208v-32C384 167.2 391.2 160 400 160h32C440.8 160 448 167.2 448 176V208zM448 112C448 120.8 440.8 128 432 128h-32C391.2 128 384 120.8 384 112v-32C384 71.16 391.2 64 400 64h32C440.8 64 448 71.16 448 80V112z"
                                        fill="currentColor" />
                                    <path class="fa-secondary"
                                        d="M48 128c-26.51 0-48 21.49-48 48v304c0 17.67 14.33 32 32 32l160-.0293V128L48 128zM128 336c0 8.836-7.164 16-16 16h-32c-8.836 0-16-7.164-16-16v-32c0-8.838 7.164-16 16-16h32c8.836 0 16 7.162 16 16V336zM128 240c0 8.836-7.164 16-16 16h-32c-8.836 0-16-7.164-16-16v-32c0-8.838 7.164-16 16-16h32c8.836 0 16 7.162 16 16V240z"
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
                                        class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{ __('Branch Offices') }}</a>
                                </div>
                                <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">
                                    {{ __('Manage your branch offices') }}</div>
                            </div>
                            @can('Add Branch Office')
                                <div class="d-flex mb-4">
                                    <a href="#" id="show_new_branch_office_form"
                                        class="btn btn-primary">{{ __('New Branch Office') }}</a>
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
                    @can('Export Branch Offices')
                        <div id="export-buttons-hiden" class="d-none"></div>
                    @endcan
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    @can('Export Branch Offices')
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
                <table id="branch_offices_table"
                    class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                        <tr>
                            <th class="min-w-100px">{{ __('ID') }}</th>
                            <th class="min-w-250px">{{ __('Branch Office Name') }}</th>
                            <th class="min-w-150px">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="fs-6">
                        @isset($branches)
                            @foreach ($branches as $branch)
                                @component('components.admin.branch_offices.branch_row')
                                    @slot('branch', $branch)
                                @endcomponent
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @can('Add Branch Office')
        @component('components.admin.modal')
            @slot('modal_id', 'modal_new_branch_office')
            @slot('title', __('New Branch Office'))
            @slot('subtitle', __('Create a new branch office'))
            @slot('alt_title', __('Edit branch office'))
            @slot('alt_subtitle', __('Edit the branch office info') . '. ')
            @slot('body')
                @include('admin.branch_offices.form_new_branch')
            @endslot
        @endcomponent
    @endcan
@endsection
