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
            </div>
        </div>
    </div>
</div>
