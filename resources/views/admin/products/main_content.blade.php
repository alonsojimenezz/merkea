<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                href="#show_product_tab_general">{{ __('General') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                href="#show_product_tab_prices">{{ __('Price') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                href="#show_product_tab_inventory">{{ __('Inventory') }}</a>
        </li>
    </ul>
    <div class="tab-content">
        @include('admin.products.main_content_general')
        @include('admin.products.main_content_prices')
        @include('admin.products.main_content_inventory')
    </div>
</div>
