@php
$cart = session()->has('cart') ? session()->get('cart') : [];
$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += ($item['price']->BasePrice - $item['price']->DiscountFixed) * $item['quantity'];
}
@endphp
<a href="javascript:void(0);" class="cart__toggle">
    <span class="cart__total-item">{{ count($cart) }}</span>
</a>
<span class="cart__content">
    <span class="cart__my">{{ __('Cart') }}:</span>
    <span class="cart__total-price">${{ number_format($subtotal, 2) }}</span>
</span>
<div class="cart__mini">
    <div class="cart__close"><button type="button" class="cart__close-btn"><i class="fal fa-times"></i></button>
    </div>
    <ul>
        <li>
            <div class="cart__title">
                <h4>{{ __('Cart') }}</h4>
                <span>(
                    @if (count($cart) == 1)
                        {{ __(':count item in cart', ['count' => count($cart)]) }}
                    @else
                        {{ __(':count items in cart', ['count' => count($cart)]) }}
                    @endif
                    )
                </span>
            </div>
        </li>
        @foreach ($cart as $item)
            <li>
                <div class="cart__item d-flex justify-content-between align-items-center">
                    <div class="cart__inner d-flex">
                        <div class="cart__thumb">
                            <a href="{{ route('store.product', ['product' => $item['slug']]) }}">
                                <img src="{{ isset($item['image']) && $item['image'] != '' ? asset($item['image']) : MProduct::product_image($item['key']) }}"
                                    alt="{{ $item['name'] }}">
                            </a>
                        </div>
                        <div class="cart__details">
                            <h6><a
                                    href="{{ route('store.product', ['product' => $item['slug']]) }}">{{ $item['name'] }}</a>
                            </h6>
                            <div class="cart__price">
                                <span>${{ number_format($item['price']->BasePrice - $item['price']->DiscountFixed, 2) }}
                                    x
                                    {{ $item['quantity'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="cart__del">
                        <a role="button" class="remove_from_cart" data-pid="{{ $item['id'] }}"><i
                                class="fal fa-trash-alt"></i></a>
                    </div>
                </div>
            </li>
        @endforeach

        <li>
            <div class="cart__sub d-flex justify-content-between align-items-center">
                <h6>{{ __('Subtotal') }}</h6>
                <span class="cart__sub-total">${{ number_format($subtotal, 2) }}</span>
            </div>
        </li>
        @if (count($cart) > 0)
            <li class="text-center">
                <a href="{{ route('store.cart') }}"
                    class="t-y-btn t-y-btn-border w-100 mb-10">{{ __('Go to cart') }}</a>
                <a role="button"
                    class="w-100 mb-10 empty_cart_button mt-2 text-uppercase">{{ __('Empty Cart') }}</a>
            </li>
        @endif
    </ul>
</div>
