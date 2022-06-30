<div class="product__item product__list white-bg mb-30 d-md-flex">
    <div class="product__thumb p-relative mr-20">
        <a href="#" class="w-img_product">
            <img src="{{ $p->Image != '' ? asset($p->Image) : MProduct::product_image($p->Key) }}"
                alt="{{ $p->Name }}">
        </a>
    </div>
    <div class="product__content">
        <h6 class="product-name">
            <a class="product-item-link" href="#">{{ $p->Name }}</a>
        </h6>
        <span class="price">${{ number_format($p->BasePrice, 2) . '  ' . $p->UnitName }}</span>
        <div class="product-text">
            {!! $p->Description !!}
        </div>
        {{-- <p class="product-text"> </p> --}}
        <div class="product__action product__action-list d-sm-flex d-lg-block d-xl-flex align-items-center">
            <button class="t-y-btn mr-10 add_to_cart" data-pid="{{ $p->Id }}">{{ __('Add to cart') }}</button>
        </div>
    </div>
</div>
