<div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4">
    <div class="product__item white-bg mb-30">
        <div class="product__thumb p-relative">
            <a href="{{ route('store.product', $p->Slug) }}" class="w-img_product">
                <img src="{{ $p->Image != '' ? asset($p->Image) : MProduct::product_image($p->Key) }}"
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
            @php
                $cart = session()->has('cart') ? session()->get('cart') : [];
            @endphp
            @if (array_key_exists($p->Id, $cart))
                <a class="t-y-btn t-y-btn-border mb-10" href="{{ route('store.cart') }}"
                    type="button">{{ __('View in cart') }}</a>
            @else
                <button class="add_to_cart" data-pid="{{ $p->Id }}"
                    type="button">{{ __('Add to cart') }}</button>
            @endif
        </div>
    </div>
</div>
