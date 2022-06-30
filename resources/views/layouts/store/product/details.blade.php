<section class="product__area box-plr-75 pb-70">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.store.product.gallery')
            @if ($product->Active == 1 && $product->CategoryActive == 1 && $product->DepartmentActive == 1)
                @include('layouts.store.product.description')
            @else
                @include('layouts.store.product.inactive')
            @endif
        </div>

    </div>
</section>
