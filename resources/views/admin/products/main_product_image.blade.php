<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('Main Image') }}</h2>
        </div>
    </div>
    <div class="card-body text-center pt-0">

        <!--begin::Image input-->
        <div id="main_product_image" class="image-input image-input-outline" data-kt-image-input="true"
            style="background-image: url({{ asset('img/no_image.png') }})">
            <!--begin::Image preview wrapper-->
            <div class="image-input-wrapper w-125px h-125px"
                style="background-image: url({{ $product->Image != '' ? asset($product->Image) : asset('img/no_image.png') }})">
            </div>
            <!--end::Image preview wrapper-->

            <!--begin::Edit button-->
            @can('Change Product Image')
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    title="{{ __('Change Image') }}">
                    <svg width="12" aria-hidden="true" focusable="false" data-prefix="fa-solid" data-icon="pencil"
                        class="svg-inline--fa fa-pencil fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path
                            d="M497.9 74.16l-60.09-60.1c-18.75-18.75-49.19-18.75-67.93 0L313.4 70.61l127.1 128l56.56-56.55C516.7 123.3 516.7 92.91 497.9 74.16zM31.04 352.1c-2.234 2.234-3.756 5.078-4.377 8.176l-26.34 131.7C-1.703 502.1 6.156 512 15.95 512c1.049 0 2.117-.1035 3.199-.3203l131.7-26.34c3.098-.6191 5.941-2.141 8.176-4.373l259.7-259.7l-128-128L31.04 352.1zM131.9 440.2l-75.14 15.03l15.03-75.15L96 355.9V416h60.12L131.9 440.2z"
                            fill="currentColor" />
                    </svg>

                    <!--begin::Inputs-->
                    <input type="hidden" id="product_id" name="product_id" value="{{ $product->Id }}">
                    <input type="file" id="product_image" name="product_image" accept=".png, .jpg, .jpeg" />
                    <!--end::Inputs-->
                </label>
            @endcan
            <!--end::Edit button-->
        </div>
        <!--end::Image input-->


        <div class="text-muted fs-7 mt-4">
            {{ __('Set the main product image. Only *.png, *.jpg and *.jpeg image files are accepted') }}</div>
    </div>
</div>
