<section class="cart-area pt-25 pb-100 ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">{{ __('Image') }}</th>
                                <th class="cart-product-name">{{ __('Product') }}</th>
                                <th class="product-price">{{ __('Unit Price') }}</th>
                                <th class="product-quantity">{{ __('Quantity') }}</th>
                                <th class="product-subtotal">{{ __('Total') }}</th>
                                <th class="product-remove">{{ __('Remove') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach ($cart as $item)
                                @php
                                    $subtotal += ($item['price']->BasePrice - $item['price']->DiscountFixed) * $item['quantity'];
                                @endphp
                                <tr>
                                    <td class="product-thumbnail"><a
                                            href="{{ route('store.product', ['product' => $item['slug']]) }}">
                                            <img src="{{ isset($item['image']) && $item['image'] != '' ? asset($item['image']) : MProduct::product_image($item['key']) }}"
                                                alt="{{ $item['name'] }}">
                                    </td>
                                    <td class="product-name">
                                        <a
                                            href="{{ route('store.product', ['product' => $item['slug']]) }}">{{ $item['name'] }}</a>
                                    </td>
                                    <td class="product-price"><span
                                            class="amount">${{ number_format($item['price']->BasePrice - $item['price']->DiscountFixed, 2) }}</span>
                                    </td>
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus p-relative">
                                            <input type="text" class="product_quantity"
                                                data-pid="{{ $item['id'] }}" value="{{ $item['quantity'] }}"
                                                data-max="{{ $item['stock']->Quantity }}"
                                                data-unitprice="{{ $item['price']->BasePrice - $item['price']->DiscountFixed }}"
                                                data-original="{{ $item['quantity'] }}" />
                                        </div>
                                        <span class="py-3">{{ __('Max') . ' ' . $item['stock']->Quantity }}</span>
                                    </td>
                                    <td class="product-subtotal"><span
                                            class="amount product-subtotal-{{ $item['id'] }}">${{ number_format(($item['price']->BasePrice - $item['price']->DiscountFixed) * $item['quantity'], 2) }}</span>
                                    </td>
                                    <td class="product-remove"><a role="button" class="remove_from_cart_c"
                                            data-pid="{{ $item['id'] }}"><i class="fa fa-times"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="coupon-all">
                            <div class="coupon2">
                                <button class="t-y-btn t-y-btn-border d-none" id="update_cart"
                                    type="submit">{{ __('Update Cart') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">
                            <h2>{{ __('Cart totals') }}</h2>
                            <ul class="mb-20">
                                <li>{{ __('Subtotal') }} <span
                                        class="subtotal_cart">${{ number_format($subtotal, 2) }}</span></li>
                                <li>{{ __('Total') }} <span
                                        class="total_cart">${{ number_format($subtotal, 2) }}</span></li>
                            </ul>
                            @if ($subtotal > 0)
                                <a id="order_now_button" class="t-y-btn"
                                    href="{{ route('store.checkout') }}">{{ __('Order now') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
