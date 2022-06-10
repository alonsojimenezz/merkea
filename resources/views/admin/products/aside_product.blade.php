<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
    @include('admin.products.main_product_image', ['product' => $product])
    @include('admin.products.featured_product', ['product' => $product])
    @include('admin.products.status_product', ['product' => $product])
    @include('admin.products.product_category', ['product' => $product])
    @include('admin.products.unit_of_measure', ['product' => $product])
    @include('admin.products.product_tags', ['product' => $product])
</div>
