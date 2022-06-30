<div class="col-xxl-7 col-xl-7 col-lg-7">
    <div class="product__details-wrapper">
        <div class="product__details">
            <h3 class="product__details-title">
                {{ $product->Name }}
            </h3>
            @if ($product->price->BasePrice)
                <div class="product__price">
                    @if ($product->price->DiscountFixed > 0)
                        <span
                            class="new">${{ number_format($product->price->BasePrice - $product->price->DiscountFixed, 2) }}</span>
                        <span class="old">${{ number_format($product->price->BasePrice, 2) }}</span>
                    @else
                        <span class="new">${{ number_format($product->price->BasePrice, 2) }}</span>
                    @endif
                </div>
            @endif
            <div class="product__stock">
                <span>{{ __('Availability') }} :</span>
                <span>
                    {{ $product->stock->Quantity > 0 && $product->price->BasePrice > 0 ? __('In Stock') : __('Out of Stock') }}
                </span>
            </div>
            <div class="product__stock sku mb-30">
                <span>SKU:</span>
                <span>{{ $product->Key }}</span>
            </div>
            <div class="product__details-des mb-30">
                {!! $product->Description ?? '' !!}
            </div>
            <div class="product__details-stock">
                @if ($product->stock->Quantity > 0 && $product->price->BasePrice > 0)
                    <h3><span>{{ __('Hurry Up!') }}</span>
                        @if ($product->stock->Quantity < 2)
                            {{ __('Only :stock product left in stock', ['stock' => $product->stock->Quantity]) }}
                        @else
                            {{ __('Only :stock products left in stock', ['stock' => $product->stock->Quantity]) }}
                        @endif
                    </h3>
                @else
                    <h3><span>{{ __('Out of Stock') }}</span>
                        {{ __('This product is currently out of stock in this moment') }}
                    </h3>
                @endif
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" data-width="100%"></div>
                </div>
            </div>
            @if ($product->stock->Quantity > 0 && $product->price->BasePrice > 0)
                <div class="product__details-quantity mb-20">
                    <form action="#">
                        <div class="pro-quan-area d-lg-flex align-items-center">
                            <div class="product-quantity mr-20 mb-25">
                                <div class="cart-plus-minus p-relative">
                                    <input id="product_quantity" data-max="{{ $product->stock->Quantity }}"
                                        type="text" value="1" disabled />
                                </div>
                            </div>
                            <div class="pro-cart-btn mb-25">
                                <button class="t-y-btn add_to_cart" data-pid="{{ $product->Id }}"
                                    type="submit">{{ __('Add to cart') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <input type="hidden" id="product_quantity" data-max="0" value="0" />
            @endif
        </div>
    </div>
</div>
