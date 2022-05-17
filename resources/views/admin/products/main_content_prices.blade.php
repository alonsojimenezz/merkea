<div class="tab-pane fade" id="show_product_tab_prices" role="tab-panel">
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('Prices per unit of measure') }}</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                @if ($product->units['assigned'] && !empty($product->units['assigned']))
                    <div class="row">
                        <select id="pricing-units-list" class="form-select form-select-solid" data-control="select2"
                            data-placeholder="{{ __('Select a Unit of Measure') }}" data-hide-search="true">
                            <option></option>
                            @foreach ($product->units['available'] as $unit)
                                @if (in_array($unit->Id, $product->units['assigned']))
                                    <option value="{{ $unit->Id }}">{{ $unit->Name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="py-5">
                        @foreach ($product->units['available'] as $unit)
                            @if (in_array($unit->Id, $product->units['assigned']))
                                @php
                                    $price = isset($product->prices[$unit->Id]) ? $product->prices[$unit->Id] : null;
                                    if ($price != null) {
                                        $price->BasePrice = number_format($price->BasePrice, 2, '.', '');
                                        $price->DiscountPercent = number_format($price->DiscountPercent, 2, '.', '');
                                        $price->DiscountFixed = number_format($price->DiscountFixed, 2, '.', '');
                                    }
                                @endphp

                                <div id="pricing-details-{{ $unit->Id }}" class="col pricing-details d-none">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <label
                                            class="required form-label">{{ __('Product Key') . ' ' . __('for') . ' ' . $unit->Name }}</label>
                                        <input type="text" id="product_key_{{ $unit->Id }}"
                                            class="form-control mb-2" placeholder="{{ __('Product Key') }}"
                                            value="{{ $price->Key ?? '' }}">
                                        <div class="text-muted fs-7">
                                            {{ __('Enter the product key') . ' ' . __('for') . ' ' . $unit->Name }}
                                        </div>
                                    </div>
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <label
                                            class="required form-label">{{ __('Barcode') . ' ' . __('for') . ' ' . $unit->Name }}</label>
                                        <input type="text" id="product_barcode_{{ $unit->Id }}"
                                            class="form-control mb-2" placeholder="{{ __('Barcode') }}"
                                            value="{{ $price->Barcode ?? '' }}">
                                        <div class="text-muted fs-7">
                                            {{ __('Enter the product barcode') . ' ' . __('for') . ' ' . $unit->Name }}
                                        </div>
                                    </div>
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <label
                                            class="required form-label">{{ __('Base Price per') . ' ' . $unit->Name }}</label>
                                        <input class="form-control form-control-solid price_per_unit"
                                            data-unit="{{ $unit->Id }}" id="price_per_unit_{{ $unit->Id }}"
                                            value="{{ isset($price->BasePrice) ? (string) $price->BasePrice : '0.00' }}">
                                        <div class="text-muted fs-7">
                                            {{ __('Set the product price per') . ' ' . $unit->Name }}</div>
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="fs-6 fw-bold mb-2">{{ __('Discount Type') }}
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title="{{ __('Select a discount type that will be applied to this product and unit of measure') }}"
                                                aria-label="{{ __('Select a discount type that will be applied to this product and unit of measure') }}"></i>
                                        </label>

                                        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9">
                                            <div class="col">
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6">
                                                    <span
                                                        class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                        <input class="form-check-input discount_option" type="radio"
                                                            data-unit="{{ $unit->Id }}"
                                                            name="discount_option_{{ $unit->Id }}" value="0"
                                                            {{ ($price != null && $price->DiscountType == 0) || $price == null ? 'checked' : '' }}>
                                                    </span>
                                                    <span class="ms-5">
                                                        <span
                                                            class="fs-5 fw-bolder text-gray-800 d-block">{{ __('No Discount') }}</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col">
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6"
                                                    data-kt-button="true">
                                                    <span
                                                        class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                        <input class="form-check-input discount_option" type="radio"
                                                            data-unit="{{ $unit->Id }}"
                                                            data-container="discount_type_container_percent_{{ $unit->Id }}"
                                                            name="discount_option_{{ $unit->Id }}" value="1"
                                                            {{ isset($price->DiscountType) && $price->DiscountType == 1 ? 'checked' : '' }}>
                                                    </span>
                                                    <span class="ms-5">
                                                        <span
                                                            class="fs-5 fw-bolder text-gray-800 d-block">{{ __('Percentage') }}
                                                            %</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col">
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6"
                                                    data-kt-button="true">
                                                    <span
                                                        class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                        <input class="form-check-input discount_option" type="radio"
                                                            data-unit="{{ $unit->Id }}"
                                                            data-container="discount_type_container_fixed_{{ $unit->Id }}"
                                                            name="discount_option_{{ $unit->Id }}" value="2"
                                                            {{ isset($price->DiscountType) && $price->DiscountType == 2 ? 'checked' : '' }}>
                                                    </span>
                                                    <span class="ms-5">
                                                        <span
                                                            class="fs-4 fw-bolder text-gray-800 d-block">{{ __('Fixed Price') }}</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-10 fv-row discount_type_container_{{ $unit->Id }} {{ isset($price->DiscountType) && $price->DiscountType == 1 ? '' : 'd-none' }}"
                                        id="discount_type_container_percent_{{ $unit->Id }}">
                                        <label class="form-label">{{ __('Set Discount Percentage') }}</label>
                                        <div class="d-flex flex-column text-center mb-5">
                                            <div class="d-flex align-items-start justify-content-center mb-7">
                                                <span class="fw-bolder fs-3x" id="discount_label_{{ $unit->Id }}">
                                                    {{ isset($price->DiscountType) && $price->DiscountType == 1 ? $price->DiscountPercent : '0' }}
                                                </span>
                                                <span class="fw-bolder fs-4 mt-1 ms-2">%</span>
                                            </div>
                                            <div class="percent_discount_slider"
                                                data-label="discount_label_{{ $unit->Id }}"
                                                id="percent_discount_slider_{{ $unit->Id }}"></div>
                                        </div>
                                        <div class="text-muted fs-7">
                                            {{ __('Set a percentage discount to be applied on this product and unit of measure') }}
                                        </div>
                                    </div>

                                    <div class="mb-10 fv-row discount_type_container_{{ $unit->Id }} {{ isset($price->DiscountType) && $price->DiscountType == 2 ? '' : 'd-none' }}"
                                        id="discount_type_container_fixed_{{ $unit->Id }}">
                                        <label class="form-label">{{ __('Fixed Discount') }}</label>
                                        <input class="form-control form-control-solid fixed_discount_per_unit"
                                            id="fixed_discount_per_unit_{{ $unit->Id }}"
                                            value="{{ isset($price->DiscountType) && $price->DiscountType == 2 ? $price->DiscountFixed : '0.00' }}">
                                        <div class="text-muted fs-7">
                                            {{ __('Set the discounted product price. The product will be reduced at the determined fixed price') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @can('Change Product Prices')
                        <div>
                            <button type="submit" id="save_product_prices" class="float-end btn btn-primary fw-bolder">
                                <span class="indicator-label">{{ __('Save') }}</span>
                                <span class="indicator-progress">{{ __('Please wait') }}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    @endcan
                @else
                    <div class="mt-3">
                        <h4>{{ __('No Units of Measure Assigned') }}</h4>
                    </div>
                @endisset
        </div>
    </div>
</div>
</div>
