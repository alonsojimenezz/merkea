<div id="kt_aside" class="aside aside-default aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_toggle">
    <div class="aside-logo flex-column-auto pt-9 pb-5" id="kt_aside_logo">
        <a href="/">
            <img alt="Logo" src="{{ asset('img/logo.png') }}" class="mh-50px logo-default" />
            <img alt="Logo" src="{{ asset('ico/fa.png') }}" class="mh-50px logo-minimize" />
        </a>
    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="menu menu-column menu-fit menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5 my-5 mt-lg-2 mb-lg-0"
            id="kt_aside_menu" data-kt-menu="true">
            <div class="menu-fit hover-scroll-y me-lg-n5 pe-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="20px"
                data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer">
                <div class="menu-item pt-5">
                    <div class="menu-content">
                        <span class="fw-bolder text-muted text-uppercase fs-7">{{ __('Catalogs') }}</span>
                    </div>
                </div>

                <div class="menu-item {{ Route::is('admin.pcategories') ? 'here' : '' }}">
                    <a class="menu-link"
                        href="{{ Route::has('admin.pcategories') ? route('admin.pcategories') : '#' }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="chart-tree-map" class="svg-inline--fa fa-chart-tree-map fa-w-16"
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
                                            d="M192 32H32C14.33 32 0 46.33 0 64v144c0 17.67 14.33 32 32 32h160c17.67 0 32-14.33 32-32V64C224 46.33 209.7 32 192 32zM480 352h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32v-64C512 366.3 497.7 352 480 352zM480 32h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32V64C512 46.33 497.7 32 480 32z"
                                            fill="currentColor" />
                                        <path class="fa-secondary"
                                            d="M192 272H32c-17.67 0-32 14.33-32 32V448c0 17.67 14.33 32 32 32h160c17.67 0 32-14.33 32-32V304C224 286.3 209.7 272 192 272zM480 192h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32V224C512 206.3 497.7 192 480 192z"
                                            fill="currentColor" />
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title fw-boldest">{{ __('Product Categories') }}</span>
                    </a>
                </div>

                <div class="menu-item {{ Route::is('admin.units') ? 'here' : '' }}">
                    <a class="menu-link" href="{{ Route::has('admin.units') ? route('admin.units') : '#' }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="ruler"
                                    class="svg-inline--fa fa-ruler fa-w-16" role="img"
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
                                            d="M86.29 267.3L63.67 289.9l56.57 56.57c3.111 3.111 7.212 4.672 11.31 4.672c9.06 0 15.99-7.32 15.99-15.99c0-4.101-1.561-8.203-4.673-11.31L86.29 267.3zM154.2 199.4L131.5 222.1l56.57 56.57c3.11 3.111 7.212 4.673 11.31 4.673c8.687 0 15.99-6.956 15.99-15.99c0-4.101-1.562-8.203-4.672-11.31L154.2 199.4zM351.2 131.5c0-4.101-1.561-8.203-4.673-11.31l-56.57-56.57l-22.63 22.63l56.57 56.57c3.111 3.111 7.212 4.672 11.31 4.672C344.3 147.5 351.2 140.2 351.2 131.5zM222.1 131.5L199.4 154.2L256 210.7c3.112 3.111 7.213 4.672 11.31 4.672c9.059 0 15.99-7.324 15.99-15.99c0-4.102-1.562-8.203-4.673-11.31L222.1 131.5z"
                                            fill="currentColor" />
                                        <path class="fa-secondary"
                                            d="M512 145.1c0 8.202-3.111 16.4-9.334 22.63L167.7 502.7C161.5 508.9 153.3 512 145.1 512s-16.41-3.111-22.63-9.334L9.334 389.5C3.111 383.3 0 375.1 0 366.9s3.111-16.4 9.334-22.63l54.33-54.33l56.57 56.57c3.111 3.111 7.212 4.672 11.31 4.672c9.06 0 15.99-7.32 15.99-15.99c0-4.101-1.561-8.203-4.673-11.31L86.29 267.3l45.25-45.26l56.57 56.57c3.11 3.111 7.212 4.673 11.31 4.673c8.687 0 15.99-6.956 15.99-15.99c0-4.101-1.562-8.203-4.672-11.31L154.2 199.4l45.25-45.26L256 210.7c3.112 3.111 7.213 4.672 11.31 4.672c9.059 0 15.99-7.324 15.99-15.99c0-4.102-1.562-8.203-4.673-11.31l-56.57-56.57l45.26-45.25l56.57 56.57c3.111 3.111 7.212 4.672 11.31 4.672c9.06 0 15.99-7.32 15.99-15.99c0-4.101-1.561-8.203-4.673-11.31l-56.57-56.57l54.33-54.33c6.223-6.223 14.43-9.334 22.63-9.334s16.4 3.111 22.63 9.334l113.1 113.1C508.9 128.7 512 136.9 512 145.1z"
                                            fill="currentColor" />
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title fw-boldest">{{ __('Units of Measure') }}</span>
                    </a>
                </div>

                <div class="menu-item {{ Route::is('admin.products') ? 'here' : '' }}">
                    <a class="menu-link"
                        href="{{ Route::has('admin.products') ? route('admin.products') : '#' }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="wine-bottle" class="svg-inline--fa fa-wine-bottle fa-w-16" role="img"
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
                        </span>
                        <span class="menu-title fw-boldest">{{ __('Products') }}</span>
                    </a>
                </div>

                <div class="menu-item {{ Route::is('admin.staff') ? 'here' : '' }}">
                    <a class="menu-link" href="{{ Route::has('admin.staff') ? route('admin.staff') : '#' }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
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
                        </span>
                        <span class="menu-title fw-boldest">{{ __('Staff') }}</span>
                    </a>
                </div>

                <div class="menu-item {{ Route::is('admin.branch_offices') ? 'here' : '' }}">
                    <a class="menu-link"
                        href="{{ Route::has('admin.branch_offices') ? route('admin.branch_offices') : '#' }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="buildings"
                                    class="svg-inline--fa fa-buildings fa-w-16" role="img"
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
                                            d="M464 0h-224C213.5 0 192 21.49 192 48v463.1L480 512c17.67 0 32-14.33 32-32V48C512 21.49 490.5 0 464 0zM320 304c0 8.836-7.164 16-16 16h-32C263.2 320 256 312.8 256 304v-32C256 263.2 263.2 256 272 256h32C312.8 256 320 263.2 320 272V304zM320 208C320 216.8 312.8 224 304 224h-32C263.2 224 256 216.8 256 208v-32C256 167.2 263.2 160 272 160h32C312.8 160 320 167.2 320 176V208zM320 112C320 120.8 312.8 128 304 128h-32C263.2 128 256 120.8 256 112v-32C256 71.16 263.2 64 272 64h32C312.8 64 320 71.16 320 80V112zM448 304c0 8.836-7.164 16-16 16h-32C391.2 320 384 312.8 384 304v-32C384 263.2 391.2 256 400 256h32C440.8 256 448 263.2 448 272V304zM448 208C448 216.8 440.8 224 432 224h-32C391.2 224 384 216.8 384 208v-32C384 167.2 391.2 160 400 160h32C440.8 160 448 167.2 448 176V208zM448 112C448 120.8 440.8 128 432 128h-32C391.2 128 384 120.8 384 112v-32C384 71.16 391.2 64 400 64h32C440.8 64 448 71.16 448 80V112z"
                                            fill="currentColor" />
                                        <path class="fa-secondary"
                                            d="M48 128c-26.51 0-48 21.49-48 48v304c0 17.67 14.33 32 32 32l160-.0293V128L48 128zM128 336c0 8.836-7.164 16-16 16h-32c-8.836 0-16-7.164-16-16v-32c0-8.838 7.164-16 16-16h32c8.836 0 16 7.162 16 16V336zM128 240c0 8.836-7.164 16-16 16h-32c-8.836 0-16-7.164-16-16v-32c0-8.838 7.164-16 16-16h32c8.836 0 16 7.162 16 16V240z"
                                            fill="currentColor" />
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title fw-boldest">{{ __('Branch Offices') }}</span>
                    </a>
                </div>

                <div class="menu-item {{ Route::is('admin.postal_coverage') ? 'here' : '' }}">
                    <a class="menu-link"
                        href="{{ Route::has('admin.postal_coverage') ? route('admin.postal_coverage') : '#' }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="envelopes-bulk" class="svg-inline--fa fa-envelopes-bulk fa-w-20"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
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
                        </span>
                        <span class="menu-title fw-boldest">{{ __('Postal Code Coverage') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
