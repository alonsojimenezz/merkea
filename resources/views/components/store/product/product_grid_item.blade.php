<div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4">
    <div class="product__item white-bg mb-30">
        <div class="product__thumb p-relative">
            <a href="{{ route('store.product', $p->Slug) }}" class="w-img">
                <img src="{{ $p->Image != '' ? asset($p->Image) : asset('img/no_image.png') }}"
                    alt="{{ $p->Name }}">
            </a>
        </div>
        <div class="product__content text-center">
            <h6 class="product-name">
                <a class="product-item-link" href="{{ route('store.product', $p->Slug) }}"> {{ $p->Name }}</a>
            </h6>
            <span class="price">${{ number_format($p->BasePrice, 2) . '  ' . $p->UnitName }}</span>
        </div>
        <div class="product__add-btn">
            <button type="button">{{ __('Add to cart') }}</button>
        </div>
    </div>
</div>
