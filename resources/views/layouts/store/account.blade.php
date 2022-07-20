<section class="grey-bg box-plr-90 pt-55 pb-100">
    <div class="container-fluid">
        <div class="row px-1 px-sm-3 px-md-5">
            <div class="col-12">
                <h1 class="fs-3 text-gray-900">{{ __('My Account') }}</h1>
            </div>
            <div class="row mt-20">
                <div class="col-md-3 d-none d-md-block">
                    <div class="mt-15 bg-light-primary text-primary py-2 px-3 fw-bolder rounded shadow-sm">
                        <svg aria-hidden="true" width="22" focusable="false" data-prefix="fa-regular"
                            data-icon="circle-user" class="svg-inline--fa fa-circle-user fa-w-16" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M256 112c-48.6 0-88 39.4-88 88C168 248.6 207.4 288 256 288s88-39.4 88-88C344 151.4 304.6 112 256 112zM256 240c-22.06 0-40-17.95-40-40C216 177.9 233.9 160 256 160s40 17.94 40 40C296 222.1 278.1 240 256 240zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-46.73 0-89.76-15.68-124.5-41.79C148.8 389 182.4 368 220.2 368h71.69c37.75 0 71.31 21.01 88.68 54.21C345.8 448.3 302.7 464 256 464zM416.2 388.5C389.2 346.3 343.2 320 291.8 320H220.2c-51.36 0-97.35 26.25-124.4 68.48C65.96 352.5 48 306.3 48 256c0-114.7 93.31-208 208-208s208 93.31 208 208C464 306.3 446 352.5 416.2 388.5z"
                                fill="currentColor" />
                        </svg>
                        <a href="#account_details_section" class="ms-2">{{ __('Personal Information') }}</a>
                    </div>
                </div>
                <div class="col-12 col-md-9 bg-white rounded shadow-sm pb-5">
                    <div class="row">
                        <div class="col mt-35 ps-4">
                            <h1 id="account_details_section" class="fs-5 text-dark">{{ __('Personal Information') }}
                            </h1>
                            <hr class="mt-1 bg-danger border-3 border-top border-warning">
                        </div>
                    </div>
                    <div class="row ps-3 mt-20">
                        <div class="col col-sm-8 col-md-6">
                            <div class="form-floating mb-3 border border-2">
                                <input type="text" class="form-control text-dark" id="full_name_input"
                                    placeholder="{{ __('Full Name') }}" value="{{$user->name ?? ''}}">
                                <label for="full_name_input" class=" text-dark">{{ __('Full Name') }} <span class="text-danger fw-bolder">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row ps-3  mt-20">
                        <div class="col col-sm-8 col-md-6">
                            <div class="form-floating mb-3 border border-2">
                                <input type="text" class="form-control text-dark" id="phone_input"
                                    placeholder="{{ __('Phone') }}" value="{{$user_info->Phone ?? ''}}">
                                <label for="phone_input" class="text-dark">{{ __('Phone') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row ps-3 mt-20">
                        <div class="col col-sm-8 col-md-6">
                            <div class="form-floating mb-3 border border-2">
                                <input type="date" class="form-control text-dark" id="birthday_input"
                                    placeholder="{{ __('Birthday') }}" value="{{$user_info->Birthday ?? ''}}">
                                <label for="birthday_input" class="text-dark">{{ __('Birthday') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row ps-3 mt-20">
                        <div class="col col-sm-8 col-md-6">
                            <button id="save_personal_info_button" class="button_mkea py-2 px-4 text-white">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
