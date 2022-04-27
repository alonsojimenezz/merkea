@extends('layouts.admin.main')

@section('toolbar')
    @component('components.toolbar')
        @slot('title', 'Staff')
        @slot('module', 'Catalogs')
        @slot('section', 'Staff')
        @slot('route_section', route('admin.staff'))
        @slot('subsection', $staff->name ?? __('Unknown Staff'))
    @endcomponent
@endsection

@section('module')
    @component('components.javascript_module')
        @slot('module', 'admin/view_staff')
    @endcomponent
@endsection

@section('content')
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <div class="container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body">
                            <div class="d-flex flex-center flex-column pt-5 pb-2">
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <div class="symbol-label bg-mkea-primary text-white fs-4x fw-bold">
                                        {{ $staff->initials() }}</div>
                                </div>
                                <a href="#"
                                    class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $staff->name ?? __('Unknown Staff') }}</a>
                                <div class="mb-9">
                                    <div class="badge badge-lg badge-light-primary d-inline">{{ __('Staff') }}</div>
                                </div>
                            </div>
                            <div class="d-flex flex-stack fs-4 pt-1 pb-3">
                                <div class="fw-bolder">
                                    {{ __('Details') }}
                                </div>
                                <span data-bs-toggle="tooltip" title="{{ __('Edit Staff Details') }}">
                                    <a id="show_edit_staff_form" data-id="{{ $staff->id }}"
                                        class="btn btn-sm btn-light-primary">{{ __('Edit') }}</a>
                                </span>
                            </div>
                            <div class="separator"></div>
                            <div>
                                <div class="pb-5 fs-6">
                                    <div class="fw-bolder mt-5">{{ __('Account ID') }}</div>
                                    <div class="text-gray-600">ID-{{ $staff->id }}</div>
                                    <div class="fw-bolder mt-5">{{ __('Email') }}</div>
                                    <div class="text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">{{ $staff->email }}</a>
                                    </div>
                                    <div class="fw-bolder mt-5">{{ __('Status') }}</div>
                                    <div>
                                        <span
                                            class="badge badge-light-{{ $staff->is_active == 1 ? 'info' : 'danger' }} fw-bolder me-auto px-4 py-3">{{ $staff->is_active == 1 ? __('Active') : __('Inactive') }}</span>
                                    </div>
                                    <div class="fw-bolder mt-5">{{ __('Last Login') }}</div>
                                    @isset($staff->last_login_time)
                                        <div class="text-gray-600">
                                            {{ __(date('F', strtotime($staff->last_login_time))) . date(' d, Y - H:i', strtotime($staff->last_login_time)) }}
                                        </div>
                                        <div class="fw-bolder mt-5">{{ __('IP') }}</div>
                                        <div class="text-gray-600">{{ $staff->last_login_ip }}</div>
                                    @else
                                        <div class="text-gray-600">{{ __('User has never logged in') }}</div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-lg-row-fluid ms-lg-15">
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#staff_permissions_tab">{{ __('Permissions') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#staff_access_logs">{{ __('Access Logs') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="staff_permissions_tab" role="tabpanel">
                            <div class="card card-flush mb-6 mb-xl-9">
                                <div class="card-header mt-6">
                                    <div class="card-title flex-column">
                                        <h2 class="mb-1">{{ __('User Permissions') }}</h2>
                                        <div class="fs-6 fw-bold text-muted">
                                            {{ __('Select the permissions the user will have') }}</div>
                                    </div>
                                </div>
                                <div class="card-body p-9 pt-4">
                                    @isset($permissions)
                                        @foreach ($permissions as $k => $category_permissions)
                                            <div class="d-flex flex-stack fs-4 pt-1 pb-3 mt-5">
                                                <div class="fw-bolder">
                                                    {{ __($k) }}
                                                </div>
                                            </div>
                                            <div class="separator"></div>
                                            @foreach ($category_permissions as $permission)
                                                <div class="form-check form-switch py-4">
                                                    <input class="form-check-input user_permissions_checkbox"
                                                        data-permission="{{ $permission }}" data-user="{{ $staff->id }}"
                                                        type="checkbox" {{ $staff->can($permission) ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-bolder">{{ __($permission) }}</label>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="staff_access_logs" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>{{ __('Logins') }}</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed gy-5">
                                            <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                                <tr class="text-start text-muted text-uppercase gs-0">
                                                    <th>{{ __('IP Address') }}</th>
                                                    <th class="min-w-125px">{{ __('Date') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fs-6 fw-bold text-gray-600">
                                                @isset($logins)
                                                    @foreach ($logins as $login)
                                                        <tr>
                                                            <td>{{ $login->last_login_ip }}</td>
                                                            <td>
                                                                {{ __(date('F', strtotime($login->last_login_time))) . date(' d, Y - H:i', strtotime($login->last_login_time)) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('Edit Staff')
        @component('components.admin.modal')
            @slot('modal_id', 'modal_edit_staff')
            @slot('title', __('Edit Staff'))
            @slot('subtitle', __('Write the new password if you want to change it, otherwise, leave the field empty'))
            @slot('body')
                @include('admin.staff.form_new_staff')
            @endslot
        @endcomponent
    @endcan

@endsection
