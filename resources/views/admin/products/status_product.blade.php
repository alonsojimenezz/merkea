<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('Status') }}</h2>
        </div>
        <div class="card-toolbar">
            <div class="rounded-circle {{ $product->Active == 1 ? 'bg-success' : 'bg-danger' }} w-15px h-15px"
                id="product_status_color">
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        @can('Change Product Status')
            <select id="product_status" class="form-select form-select-solid" data-control="select2"
                data-placeholder="{{ __('Select Status') }}" data-hide-search="true">
                <option value="1" {{ $product->Active == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                <option value="0" {{ $product->Active == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
            </select>
        @else
            <label>
                {{ $product->Active == 1 ? __('Active') : __('Inactive') }}
            </label>
        @endcan
    </div>
</div>
