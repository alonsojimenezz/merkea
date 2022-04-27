@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', 'Product Categories')
        @slot('module', 'Catalogs')
        @slot('section', 'Product Categories')
    @endcomponent
@endsection

@section('module')
    @component('components.javascript_module')
        @slot('module', 'admin/product_categories')
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
                            <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="chart-tree-map"
                                class="svg-inline--fa fa-chart-tree-map fa-w-16" role="img"
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
                                        d="M192 32H32C14.33 32 0 46.33 0 64v144c0 17.67 14.33 32 32 32h160c17.67 0 32-14.33 32-32V64C224 46.33 209.7 32 192 32zM480 352h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32v-64C512 366.3 497.7 352 480 352zM480 32h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32V64C512 46.33 497.7 32 480 32z"
                                        fill="currentColor" />
                                    <path class="fa-secondary"
                                        d="M192 272H32c-17.67 0-32 14.33-32 32V448c0 17.67 14.33 32 32 32h160c17.67 0 32-14.33 32-32V304C224 286.3 209.7 272 192 272zM480 192h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32V224C512 206.3 497.7 192 480 192z"
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
                                        class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{ __('Categories') }}</a>
                                </div>
                                <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">
                                    {{ __('Manage your product categories') }}</div>
                            </div>
                            @can('Add Product Categories')
                                <div class="d-flex mb-4">
                                    <a href="#" id="show_new_category_form"
                                        class="btn btn-primary">{{ __('New Category') }}</a>
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
                    @can('Export Product Categories')
                        <div id="export-buttons-hiden" class="d-none"></div>
                    @endcan
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    @can('Export Product Categories')
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
                <table id="product_categories_table"
                    class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                        <tr>
                            <th class="min-w-100px">{{ __('ID') }}</th>
                            <th class="min-w-200px">{{ __('Category') }}</th>
                            <th class="min-w-200px">{{ __('Parent Category') }}</th>
                            <th class="min-w-150px">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="fs-6">
                        @foreach ($categories as $category)
                            @component('components.admin.categories.category_row')
                                @slot('category', $category)
                            @endcomponent
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @can('Add Product Categories')
        @component('components.admin.modal')
            @slot('modal_id', 'modal_new_category')
            @slot('title', __('New Category'))
            @slot('subtitle', __('Create a new category for your products'))
            @slot('alt_title', __('Edit Category'))
            @slot('alt_subtitle',
                __('Edit the category of your products') .
                '. ' .
                __('Remember that this change affects all
                associated products'),)
                @slot('body')
                    @include('admin.product_categories.form_new_category')
                @endslot
            @endcomponent
        @endcan
    @endsection
