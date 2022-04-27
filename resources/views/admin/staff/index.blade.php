    @extends('layouts.admin.main')

    @section('toolbar')
        @component('components.toolbar')
            @slot('title', 'Staff')
            @slot('module', 'Catalogs')
            @slot('section', 'Staff')
        @endcomponent
    @endsection

    @section('module')
        @component('components.javascript_module')
            @slot('module', 'admin/staff')
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
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="clipboard-user" class="svg-inline--fa fa-clipboard-user fa-w-12"
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
                                            d="M256 64c0-35.35-28.65-64-64-64S128 28.65 128 64C92.65 64 64 92.65 64 128v16C64 152.8 71.16 160 80 160h224C312.8 160 320 152.8 320 144V128C320 92.65 291.3 64 256 64zM192 88C178.7 88 168 77.25 168 64c0-13.26 10.75-24 24-24S216 50.74 216 64C216 77.25 205.3 88 192 88zM224 352H160c-44.18 0-80 35.82-80 80C80 440.8 87.16 448 96 448h192c8.836 0 16-7.164 16-16C304 387.8 268.2 352 224 352zM256 256c0-35.35-28.65-64-64-64S128 220.7 128 256s28.65 64 64 64S256 291.3 256 256z"
                                            fill="currentColor" />
                                        <path class="fa-secondary"
                                            d="M336 64H256c35.35 0 64 28.65 64 64v16C320 152.8 312.8 160 304 160h-224C71.16 160 64 152.8 64 144V128c0-35.35 28.65-64 64-64H48C21.49 64 0 85.49 0 112v352C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48v-352C384 85.49 362.5 64 336 64zM192 192c35.35 0 64 28.65 64 64s-28.65 64-64 64S128 291.3 128 256S156.7 192 192 192zM288 448H96c-8.836 0-16-7.164-16-16C80 387.8 115.8 352 160 352h64c44.18 0 80 35.82 80 80C304 440.8 296.8 448 288 448z"
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
                                            class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{ __('Staff') }}</a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">
                                        {{ __('Manage your staff and permissions assigned') }}</div>
                                </div>
                                @can('Add Staff')
                                    <div class="d-flex mb-4">
                                        <a href="#" id="show_new_staff_form"
                                            class="btn btn-primary">{{ __('New Staff') }}</a>
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
                        @can('Export Staff')
                            <div id="export-buttons-hiden" class="d-none"></div>
                        @endcan
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        @can('Export Staff')
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
                    <table id="staff_table"
                        class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer">
                        <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr>
                                <th class="min-w-70px">{{ __('ID') }}</th>
                                <th class="min-w-150px">{{ __('Name') }}</th>
                                <th class="min-w-250px">{{ __('Email') }}</th>
                                <th class="min-w-150px">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @isset($staffs)
                                @foreach ($staffs as $staff)
                                    @component('components.admin.staff.staff_row')
                                        @slot('staff', $staff)
                                    @endcomponent
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @can('Add Staff')
            @component('components.admin.modal')
                @slot('modal_id', 'modal_new_staff')
                @slot('title', __('New Staff'))
                @slot('subtitle', __('You can create users for your staff. If the email is invalid, you will not receive notifications'))
                @slot('body')
                    @include('admin.staff.form_new_staff')
                @endslot
            @endcomponent
        @endcan
    @endsection
