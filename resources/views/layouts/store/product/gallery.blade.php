<div class="col-xxl-5 col-xl-5 col-lg-5">
    <div class="product__details-nav d-sm-flex align-items-start">
        <ul class="nav nav-tabs flex-sm-column justify-content-between" id="productThumbTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="thumbOne-tab" data-bs-toggle="tab" data-bs-target="#thumbOne"
                    type="button" role="tab" aria-controls="thumbOne" aria-selected="true">
                    <img src="{{ $product->Image != '' ? asset($product->Image) : MProduct::product_image($product->Key) }}"
                        alt="{{ $product->Name }}">
                </button>
            </li>
            @foreach ($product->gallery as $image)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="thumb{{ $image->Id }}-tab" data-bs-toggle="tab"
                        data-bs-target="#thumb{{ $image->Id }}" type="button" role="tab"
                        aria-controls="thumb{{ $image->Id }}" aria-selected="false">
                        <img src="{{ asset($image->Image) }}" alt="{{ $product->Name }}">
                    </button>
                </li>
            @endforeach
        </ul>
        <div class="product__details-thumb">
            <div class="tab-content" id="productThumbContent">
                <div class="tab-pane fade show active" id="thumbOne" role="tabpanel" aria-labelledby="thumbOne-tab">
                    <div class="product__details-nav-thumb">
                        <img src="{{ $product->Image != '' ? asset($product->Image) : MProduct::product_image($product->Key) }}"
                            alt="{{ $product->Name }}">
                    </div>
                </div>
                @foreach ($product->gallery as $image)
                    <div class="tab-pane fade" id="thumb{{ $image->Id }}" role="tabpanel"
                        aria-labelledby="thumb{{ $image->Id }}-tab">
                        <div class="product__details-nav-thumb">
                            <img src="{{ asset($image->Image) }}" alt="{{ $product->Name }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
