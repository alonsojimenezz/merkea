<div class="tab-pane fade show active" id="show_product_tab_general" role="tab-panel">
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>General</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <form id="general_product_form" class="form" action="#">
                    <div class="mb-10 fv-row">
                        <label class="required form-label">{{ __('Product Name') }}</label>
                        <input type="text" id="general_product_name" name="product_name" class="form-control mb-2"
                            placeholder="{{ __('Product Name') }}" value="{{ $product->Name }}" required
                            data-fv-not-empty="true"
                            data-fv-not-empty___message="{{ __('Product Name is required') }}">
                        <div class="text-muted fs-7">
                            {{ __('A product name is required and recommended to be unique') }}
                        </div>
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="required form-label">{{ __('Product Slug') }}</label>
                        <input type="text" id="general_product_slug" name="product_slug" class="form-control mb-2"
                            placeholder="{{ __('Product Slug') }}" value="{{ $product->Slug }}" required
                            data-fv-not-empty="true"
                            data-fv-not-empty___message="{{ __('Product Slug is required') }}">
                        <div class="text-muted fs-7">
                            {{ __('Refers to the final part of a URL after the backslash (/) that will identify the product') }}
                        </div>
                    </div>
                    <div>
                        <label class="form-label">{{ __('Description') }}</label>
                        <div id="product_description">{!! $product->Description ?? '' !!}</div>
                        <div class="mt-2 text-muted fs-7">
                            {{ __('Set a description to the product for better visibility') }}</div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" id="general_product_button"
                            class="float-end btn btn-outline btn-outline-dashed btn-outline-warning btn-active-warning fw-bolder">
                            <span class="indicator-label">{{ __('Save') }}</span>
                            <span class="indicator-progress">{{ __('Please wait') }}...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('Image Gallery') }}</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                @can('Modify Product Gallery')
                    <div class="fv-row mb-2">
                        <div class="dropzone" id="general_image_gallery">
                            <div class="dz-message needsclick">
                                <span class="svg-icon svg-icon-3x svg-icon-warning ">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fa-solid"
                                        data-icon="file-arrow-up" class="svg-inline--fa fa-file-arrow-up fa-w-12" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                        <path
                                            d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM288.1 344.1C284.3 349.7 278.2 352 272 352s-12.28-2.344-16.97-7.031L216 305.9V408c0 13.25-10.75 24-24 24s-24-10.75-24-24V305.9l-39.03 39.03c-9.375 9.375-24.56 9.375-33.94 0s-9.375-24.56 0-33.94l80-80c9.375-9.375 24.56-9.375 33.94 0l80 80C298.3 320.4 298.3 335.6 288.1 344.1z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <div class="ms-4">
                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                        {{ __('Drop the images here or click to upload') }}</h3>
                                    <span
                                        class="fs-7 fw-bold text-gray-400">{{ __('Upload up to 10 images at time') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-muted fs-7">{{ __('Set the product image gallery') }}</div>
                @endcan
                <div class="mt-5">
                    @isset($product->gallery)
                        @foreach ($product->gallery as $image)
                            <div class="symbol symbol-125px shadow p-3 mb-5 bg-body rounded m-3"
                                id="gallery-{{ $image->Id }}">
                                <div class="symbol-label"
                                    style="background-image:url('{{ $image->Image != '' ? asset($image->Image) : asset('img/no_image.png') }}')">
                                </div>
                                <span
                                    class="symbol-badge badge badge-circle bg-danger start-100 general_gallery_delete_button"
                                    data-gallery="{{ $image->Id }}">
                                    <span role="button" class="svg-icon svg-icon-white">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fa-solid" data-icon="xmark"
                                            class="svg-inline--fa fa-xmark fa-w-10" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <path
                                                d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('Units of Measure') }}</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <select name="general_product_units" id="general_product_units" class="form-select form-select-solid"
                    data-control="select2" data-placeholder="{{ __('Select Units of Measure') }}"
                    data-allow-clear="true" multiple="multiple">

                    @isset($product->units['available'])
                        @foreach ($product->units['available'] as $unit)
                            <option value="{{ $unit->Id }}"
                                {{ in_array($unit->Id, $product->units['assigned']) ? 'selected' : '' }}>
                                {{ $unit->Name . ' (' . $unit->Key . ')' }}</option>
                        @endforeach
                    @endisset
                </select>
                <div class="text-muted fs-7 mt-3">{{ __('Add units of measure to the product') }}</div>
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
    </div>
</div>
