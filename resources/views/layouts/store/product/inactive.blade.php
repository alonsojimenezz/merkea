<div class="col-xxl-7 col-xl-7 col-lg-7">
    <div class="product__details-wrapper">
        <div class="product__details">
            <h3 class="product__details-title">
                {{ $product->Name }}
            </h3>
            <div class="product__stock">
                <span>{{ __('Availability') }} :</span>
                <span>
                    {{ __('The product is not for sale at this time') }}
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
                <h3><span>{{ __('The product is not for sale at this time') }}</span> </h3>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" data-width="100%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
