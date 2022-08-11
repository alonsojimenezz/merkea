<section class="cart-area pt-25 pb-100 ">
    <div class="container">
        <div class="row d-block d-md-none mb-3">
            <div class="col-12">
                @foreach ($cart as $item)
                    <div class="row border-top border-1 my-4 py-4 ">
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <div class="align-self-center">
                                <a href="{{ route('store.product', ['product' => $item['slug']]) }}">
                                    <img src="{{ isset($item['image']) && $item['image'] != '' ? asset($item['image']) : MProduct::product_image($item['key']) }}"
                                        alt="{{ $item['name'] }}" style="width:160px; height: 160px; object-fit:contain">
                                </a>
                            </div>
                        </div>
                        <div class="col-5 d-flex flex-column justify-content-center">
                            <div class="align-self-center mb-2">
                                <a class="fs-10 fw-bolder"
                                    href="{{ route('store.product', ['product' => $item['slug']]) }}">{{ $item['name'] }}</a>
                            </div>
                            <div class="align-self-start text-dark">
                                <span class="cart_span_symbol_decimals fs-7">$</span>
                                @php
                                    $price = number_format($item['price']->BasePrice - $item['price']->DiscountFixed, 2);
                                @endphp
                                <span class="fs-2">{{ substr($price, 0, -3) }}</span>
                                <span class="cart_span_symbol_decimals fs-7">{{ substr($price, -2) }}</span>
                            </div>
                        </div>
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <div class="d-flex flex-row mx-3">
                                <div class="dec qtybutton">
                                    <span class="input-group-text">-</span>
                                </div>
                                <div>
                                    <input type="text"
                                        class="product_quantity product_quantity_small_screen product_quantity_{{ $item['id'] }} w-100 form-control bg-white text-center"
                                        data-granel="{{ $item['granel'] ?? 0 }}" data-pid="{{ $item['id'] }}"
                                        value="{{ $item['quantity'] }}" data-max="{{ $item['stock']->Quantity }}"
                                        data-unitprice="{{ $item['price']->BasePrice - $item['price']->DiscountFixed }}"
                                        data-original="{{ $item['quantity'] }}"
                                        {{ $item['granel'] == 1 ? '' : 'disabled' }} />
                                </div>
                                <div class="inc qtybutton">
                                    <span class="input-group-text">+</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 d-flex flex-column justify-content-center">
                            <div>
                                <a class="btn btn-outline-danger btn-sm px-4 rounded remove_from_cart_c"
                                    data-pid="{{ $item['id'] }}">{{ __('Delete') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive d-none d-md-block">
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
                                            <input type="text"
                                                class="product_quantity product_quantity_{{ $item['id'] }}"
                                                data-granel="{{ $item['granel'] ?? 0 }}"
                                                data-pid="{{ $item['id'] }}" value="{{ $item['quantity'] }}"
                                                data-max="{{ $item['stock']->Quantity }}"
                                                data-unitprice="{{ $item['price']->BasePrice - $item['price']->DiscountFixed }}"
                                                data-original="{{ $item['quantity'] }}"
                                                {{ $item['granel'] == 1 ? '' : 'disabled' }} />
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
