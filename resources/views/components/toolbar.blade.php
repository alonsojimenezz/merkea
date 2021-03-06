<div class="toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2 text-mkea-primary">{{ __($title) }}</h1>
            <ul class="breadcrumb fw-bold fs-base my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}"
                        class="text-muted text-hover-primary">{{ __('Administrator Panel') }}</a>
                </li>
                <li class="breadcrumb-item text-muted">{{ __($module) }}</li>
                @isset($route_section)
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ $route_section }}" class="text-muted text-hover-primary">{{ __($section) }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item text-dark">{{ __($section) }}</li>
                @endisset
                @isset($subsection)
                    <li class="breadcrumb-item text-dark">{{ __($subsection) }}</li>
                @endisset
            </ul>
        </div>
    </div>
</div>
