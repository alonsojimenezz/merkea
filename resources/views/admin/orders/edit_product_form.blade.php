<div class="card mb-5 mb-xxl-8">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img style="object-fit: scale-down" id="edit_product_image" src="" alt="Product Image">
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <a id="edit_product_name" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"></a>
                        </div>
                        <div class="d-flex flex-wrap fw-bold fs-6 mb-2 pe-2">
                            <a id="edit_product_key" class="d-flex align-items-center text-gray-400 me-5 mb-2"></a>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <a id="edit_product_price" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"></a>
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <a role="button" class="p-3 bg-gray-50 bg-hover-gray-100" id="minus_button">
                                    <svg aria-hidden="true" width="12" focusable="false" data-prefix="fa-solid"
                                        data-icon="minus" class="svg-inline--fa fa-minus fa-w-14" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path
                                            d="M400 288h-352c-17.69 0-32-14.32-32-32.01s14.31-31.99 32-31.99h352c17.69 0 32 14.3 32 31.99S417.7 288 400 288z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col-8">
                                <input type="text" id="edit_product_quantity" class="form-control text-center"
                                    data-granel="" data-max="">
                            </div>
                            <div class="col-2 d-flex align-items-center">
                                <a role="button" class="p-3 align-self-center" id="plus_button">
                                    <svg aria-hidden="true" width="12" focusable="false" data-prefix="fa-regular"
                                        data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path
                                            d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <button type="reset" data-bs-dismiss="modal"
                class="btn btn-light me-3 btn-sm">{{ __('Cancel') }}</button>
            <button id="delete_product_order"
                class="btn btn-light me-3 btn-danger btn-sm me-5">{{ __('Delete Product') }}</button>
            <button id="save_product_changes" class="btn btn-warning btn-sm ms-5">{{ __('Save') }} </button>
        </div>
    </div>
</div>
