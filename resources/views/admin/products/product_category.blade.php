<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('Category') }}</h2>
        </div>
    </div>
    <div class="card-body pt-0">
        @can('Change Product Category')
            <select id="product_category" class="form-select form-select-solid" data-control="select2"
                data-placeholder="{{ __('Select Category') }}" >
                <option></option>
                @isset($categories)
                    @foreach ($categories as $category)
                        <option value="{{ $category->Id }}" {{ $product->CategoryId == $category->Id ? 'selected' : '' }}>
                            {{ $category->Name . ' (' . $category->ParentName . ')' }}
                        </option>
                    @endforeach
                @endisset
            </select>
        @else
            <label>
                {{ isset($product->category) && isset($product->category->Name) ? $product->category->Name : __('Uncategorized') }}
            </label>
        @endcan
    </div>
</div>
