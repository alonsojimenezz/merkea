<div class="card mb-5 mb-xxl-8">
    <div class="card-body pt-0 pb-0">
        <div id="add_product_search_modal">
            <div class="row">
                <div class="col">
                    <div class="input-group mb-5">
                        <input type="text" id="search_product_text" data-branch="{{ $order->BranchId }}"
                            class="form-control" placeholder="{{ __('SKU, Name or Product Tag') }}"
                            aria-label="{{ __('SKU, Name or Product Tag') }}"
                            aria-describedby="search_product_button" />
                        <span role="button" class="input-group-text text-hover-white bg-hover-warning"
                            id="search_product_button">
                            <svg width="18" aria-hidden="true" focusable="false" data-prefix="fa-solid"
                                data-icon="magnifying-glass" class="svg-inline--fa fa-magnifying-glass fa-w-16"
                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div id="search_product_result">
            <div id="empty_search_alert" class="d-none">
                <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.3"
                                d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z"
                                fill="black"></path>
                            <path
                                d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z"
                                fill="black"></path>
                        </svg>
                    </span>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h4 class="fw-bold">{{ __('Empty search field') }}</h4>
                        <span>{{ __('At least one word is required to search for your product') }}</span>
                    </div>
                </div>
            </div>
            <div id="no_results" class="d-none">
                <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.3"
                                d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z"
                                fill="black"></path>
                            <path
                                d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z"
                                fill="black"></path>
                        </svg>
                    </span>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h4 class="fw-bold">{{ __('No results found') }}</h4>
                    </div>
                </div>
            </div>
            <div id="search_product_result_table" class="d-none">
            </div>
        </div>
        <div class="d-none" id="add_product_details_modal">
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img style="object-fit: scale-down" id="add_product_image" src="" alt="Product Image">
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a id="add_product_name"
                                    class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"></a>
                            </div>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-2 pe-2">
                                <a id="add_product_key" class="d-flex align-items-center text-gray-400 me-5 mb-2"></a>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <a id="add_product_price"
                                    class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"></a>
                            </div>
                            <div class="row">
                                <div class="col-2 d-flex align-items-center">
                                    <a role="button" class="p-3 bg-gray-50 bg-hover-gray-100" id="minus_button_add">
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
                                    <input type="text" id="add_product_quantity" data-order="{{ $order->Id }}"
                                        class="form-control text-center">
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <a role="button" class="p-3 align-self-center" id="plus_button_add">
                                        <svg aria-hidden="true" width="12" focusable="false"
                                            data-prefix="fa-regular" data-icon="plus"
                                            class="svg-inline--fa fa-plus fa-w-14" role="img"
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
                <button id="back_to_search" class="btn btn-light me-3 btn-sm">{{ __('Back') }}</button>
                <button id="add_product_to_order" class="btn btn-success btn-sm ms-5">{{ __('Add Product') }}
                </button>
            </div>
        </div>
    </div>
</div>
