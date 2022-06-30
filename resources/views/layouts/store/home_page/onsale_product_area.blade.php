<section class="onsell__area pb-20 grey-bg-2" style="padding-top: 15px;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section__head d-flex justify-content-between mb-40">
                    <div class="section__title">
                        <h3>{{ __('Featured Products') }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="sale__slider-3 owl-carousel t-nav">
                    @php
                        $j = 0;
                    @endphp
                    @foreach ($featured_products as $product)
                        @if ($j == 0)
                            <div class="product__item-wrapper">
                        @endif
                        <div class="product__item white-bg d-flex mb-20">
                            <div class="product__thumb product__thumb-sale p-relative">
                                <a href="{{ route('store.product', $product->Slug) }}" class="w-img">
                                    <img src="{{ $product->Image != '' ? asset($product->Image) : MProduct::product_image($product->Key) }}"
                                        alt="{{ $product->Name }}">
                                </a>
                            </div>
                            <div class="product__content ml-15">
                                <h6 class="product-name">
                                    <a class="product-item-link"
                                        href="{{ route('store.product', $product->Slug) }}">{{ $product->Name }}</a>
                                </h6>
                                @if ($product->DiscountFixed > 0)
                                    <span
                                        class="new new-2">${{ number_format($product->BasePrice - $product->DiscountFixed, 2) . '  ' . $product->UnitName }}
                                    </span><br>
                                    <span class="price-old"> <del>${{ number_format($product->BasePrice, 2) }}</del>
                                    </span>
                                @else
                                    <span
                                        class="new new-2">${{ number_format($product->BasePrice, 2) . '  ' . $product->UnitName }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        @php
                            $j++;
                        @endphp
                        @if ($j == 2)
                </div>
                @php
                    $j = 0;
                @endphp
                @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
