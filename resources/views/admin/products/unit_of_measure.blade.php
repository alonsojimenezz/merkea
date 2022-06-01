<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('Unit of Measure') }}</h2>
        </div>
    </div>
    <div class="card-body pt-0">
        <select name="general_product_units" id="general_product_units" class="form-select form-select-solid"
            data-control="select2" data-placeholder="{{ __('Select Units of Measure') }}" data-allow-clear="true">

            @isset($units)
                @foreach ($units as $unit)
                    <option value="{{ $unit->Id }}" {{ $product->UnitId == $unit->Id ? 'selected' : '' }}>
                        {{ $unit->Name . ' (' . $unit->Key . ')' }}</option>
                @endforeach
            @endisset
        </select>
        <div class="text-muted fs-7 mt-3">{{ __('Select the main unit of measure of the product') }}</div>
        @can('Change Product Units')
            <div class="mt-4">
                <button type="submit" id="save_units_of_measure_button"
                    class="d-none float-end btn btn-outline btn-outline-dashed btn-outline-warning btn-active-warning fw-bolder">
                    <span class="indicator-label">{{ __('Save') }}</span>
                    <span class="indicator-progress">{{ __('Please wait') }}...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        @endcan
    </div>
</div>
