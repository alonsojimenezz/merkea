<div class="tab-pane fade" id="show_product_tab_prices" role="tab-panel">
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('Product price and discount') }}</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="py-5">
                    @foreach ($branches as $branch)
                        <div class="col-12 bg-mkea-primary py-2 px-4 text-white fw-bold ls-2">
                            {{ $branch->Name }}
                        </div>
                        <div class="col-12 pt-2 border-bottom border-warning">
                            <div class="row pb-1 px-4">
                                <div class="col-4 text-start mt-3">
                                    <label class="required form-label">{{ __('Base Price') }} $</label>
                                </div>
                                <div class="col-4">
                                    <input type="number" data-branch="{{ $branch->Id }}"
                                        class="form-control form-control-sm product_price"
                                        value="{{ number_format($product->prices[$branch->Id]->BasePrice ?? 0, 2) }}"
                                        name="product_price_{{ $branch->Id }}"
                                        id="product_price_{{ $branch->Id }}" min="0" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-2 border-bottom border-warning mb-10">
                            <div class="row pb-1 px-4">
                                <div class="col-4 text-start mt-3">
                                    <label class="form-label">{{ __('Fixed Discount') }} $</label>
                                </div>
                                <div class="col-4">
                                    <input type="number" data-branch="{{ $branch->Id }}"
                                        class="form-control form-control-sm product_discount"
                                        value="{{ number_format($product->prices[$branch->Id]->DiscountFixed ?? 0, 2) }}"
                                        name="product_discount_{{ $branch->Id }}"
                                        id="product_discount_{{ $branch->Id }}" min="0" />
                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{-- @php
                        $price = isset($product->price) && isset($product->price[0]) ? $product->price[0] : null;
                        if ($price != null) {
                            $price->BasePrice = number_format($price->BasePrice, 2, '.', '');
                            $price->DiscountPercent = number_format($price->DiscountPercent, 2, '.', '');
                            $price->DiscountFixed = number_format($price->DiscountFixed, 2, '.', '');
                        }
                    @endphp


                    <div class="col">
                        <div class="mb-10 fv-row fv-plugins-icon-container">
                            <label class="required form-label">{{ __('Base Price') }}</label>
                            <input class="form-control form-control-solid product_price" id="product_price"
                                value="{{ isset($price->BasePrice) ? (string) $price->BasePrice : '0.00' }}">
                            <div class="text-muted fs-7">
                                {{ __('Set the product price') }}</div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-bold mb-2">{{ __('Discount Type') }}
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="{{ __('Select a discount type that will be applied to this product') }}"
                                    aria-label="{{ __('Select a discount type that will be applied to this product') }}"></i>
                            </label>

                            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9">
                                <div class="col">
                                    <label
                                        class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6">
                                        <span
                                            class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                            <input class="form-check-input discount_option" type="radio"
                                                name="discount_option" value="0"
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
                                                data-container="discount_type_container_percent" name="discount_option"
                                                value="1"
                                                {{ isset($price->DiscountType) && $price->DiscountType == 1 ? 'checked' : '' }}>
                                        </span>
                                        <span class="ms-5">
                                            <span class="fs-5 fw-bolder text-gray-800 d-block">{{ __('Percentage') }}
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
                                                data-container="discount_type_container_fixed" name="discount_option"
                                                value="2"
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

                        <div class="mb-10 fv-row discount_type_container {{ isset($price->DiscountType) && $price->DiscountType == 1 ? '' : 'd-none' }}"
                            id="discount_type_container_percent">
                            <label class="form-label">{{ __('Set Discount Percentage') }}</label>
                            <div class="d-flex flex-column text-center mb-5">
                                <div class="d-flex align-items-start justify-content-center mb-7">
                                    <span class="fw-bolder fs-3x" id="discount_label">
                                        {{ isset($price->DiscountType) && $price->DiscountType == 1 ? $price->DiscountPercent : '0' }}
                                    </span>
                                    <span class="fw-bolder fs-4 mt-1 ms-2">%</span>
                                </div>
                                <div class="percent_discount_slider" data-label="discount_label"
                                    id="percent_discount_slider"></div>
                            </div>
                            <div class="text-muted fs-7">
                                {{ __('Set a percentage discount to be applied on this product') }}
                            </div>
                        </div>

                        <div class="mb-10 fv-row discount_type_container {{ isset($price->DiscountType) && $price->DiscountType == 2 ? '' : 'd-none' }}"
                            id="discount_type_container_fixed">
                            <label class="form-label">{{ __('Fixed Discount') }}</label>
                            <input class="form-control form-control-solid fixed_discount" id="fixed_discount"
                                value="{{ isset($price->DiscountType) && $price->DiscountType == 2 ? $price->DiscountFixed : '0.00' }}">
                            <div class="text-muted fs-7">
                                {{ __('Set the discounted product price. The product will be reduced at the determined fixed price') }}
                            </div>
                        </div>
                    </div> --}}

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
            </div>
        </div>
    </div>
</div>
