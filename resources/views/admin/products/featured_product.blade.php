<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('Highlight Product') }}</h2>
        </div>
    </div>
    <div class="card-body pt-0">
        @can('Highlight Product')
            <select id="product_highlight" class="form-select form-select-solid" data-control="select2"
                data-placeholder="{{ __('Highlight product') }}" data-hide-search="true">
                <option value="1" {{ $product->Highlight == 1 ? 'selected' : '' }}>{{ __('Featured product') }}</option>
                <option value="0" {{ $product->Highlight == 0 ? 'selected' : '' }}>{{ __('Product not featured') }}
                </option>
            </select>
        @else
            <label>
                {{ isset($product->Highlight) && $product->Highlight == 1 ? __('Featured product') : __('Product not featured') }}
            </label>
        @endcan
    </div>
</div>
