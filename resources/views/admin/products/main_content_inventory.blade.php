<div class="tab-pane fade" id="show_product_tab_inventory" role="tab-panel">
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('Inventory') }}</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="py-5">
                    <div class="row border-bottom border-warning border-2 mb-3 pb-1">
                        <div class="col-md-8 fw-bolder">
                            {{ __('Branch Office') }}
                        </div>
                        <div class="col-md-4 fw-bolder border-start border-warning border-2 text-center">
                            {{ __('Stock') }}
                        </div>
                    </div>
                    @foreach ($branches as $branch)
                        <div class="row py-2 border-bottom border-warning">
                            <div class="col-md-8">
                                {{ $branch->Name }}
                            </div>
                            <div class="col-md-4">
                                <input type="number" data-branch="{{ $branch->Id }}"
                                    class="form-control form-control-sm product_stock"
                                    value="{{ $product->stock[$branch->Id]->Quantity ?? 0 }}"
                                    name="product_stock_[{{ $branch->Id }}]" id="product_stock_[{{ $branch->Id }}]"
                                    min="0" />
                            </div>
                        </div>
                    @endforeach

                    @can('Modify Product Stock')
                        <div class="mt-4">
                            <button type="submit" id="product_stock_save_button"
                                class="float-end btn btn-outline btn-outline-dashed btn-outline-warning btn-active-warning fw-bolder">
                                <span class="indicator-label">{{ __('Save') }}</span>
                                <span class="indicator-progress">{{ __('Please wait...') }}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    @endcan
                </div>

            </div>
        </div>
    </div>

    <div class="d-flex flex-column gap-7 gap-lg-10 mt-4">
        <div class="card card-flush py-4">
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
                    <div id="export-buttons-hiden" class="d-none"></div>
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
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
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="py-5 table-responsive">
                    <table id="product_movements_table"
                        class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder no-footer">
                        <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr>
                                <th class="min-w-70px">ID</th>
                                <th class="min-w-150px">{{ __('Date') }}</th>
                                <th class="min-w-125px">{{ __('Branch Office') }}</th>
                                <th class="min-w-70px">{{ __('Previous Quantity') }}</th>
                                <th class="min-w-70px">{{ __('New Quantity') }}</th>
                                <th class="min-w-125px">{{ __('Reason') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->movements as $movement)
                                <tr>
                                    <td>{{ $movement->Id }}</td>
                                    <td>{{ $movement->created_at }}</td>
                                    <td>{{ $movement->BranchName }}</td>
                                    <td>{{ $movement->PreviousQuantity }}</td>
                                    <td>{{ $movement->Quantity }}</td>
                                    <td>{{ __($movement->Description) }}
                                        <strong>{{ $movement->UserName }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
