<form id="new_staff_form" class="form" action="#">
    <input type="hidden" id="staff_id" name="staff_id" value="0">
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">{{ __('Staff Name') }}</span>
        </label>
        <input id="staff_name" name="staff_name" type="text" data-fv-not-empty="true"
            data-fv-not-empty___message="{{ __('Staff Name is required') }}" class="form-control form-control-solid"
            placeholder="{{ __('Merkea Staff') }}">
    </div>
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">{{ __('Staff Email') }}</span>
        </label>
        <input id="staff_email" name="staff_email" type="email" data-fv-not-empty="true"
            data-fv-not-empty___message="{{ __('Staff email is required') }}" data-fv-email-address="true"
            data-fv-email-address___message="{{ __('The email address is not valid') }}"
            class="form-control form-control-solid" placeholder="{{ __('staff@email.com') }}">
    </div>
    <div class="mb-8 fv-row" data-kt-password-meter="true">
        <div class="mb-1">
            <label class="form-label fw-bold fs-6 mb-2 required">
                {{ __('Staff Password') }}
            </label>

            <div class="position-relative mb-3">
                <input id="staff_password" name="staff_password" type="password" data-fv-not-empty="true"
                    data-fv-not-empty___message="{{ __('Password is required') }}" data-fv-string-length="true"
                    data-fv-string-length___min="8"
                    data-fv-string-length___message="{{ __('Password must be at least 8 characters') }}"
                    class="form-control form-control-lg form-control-solid" placeholder="" autocomplete="off" />

                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                    data-kt-password-meter-control="visibility">
                    <span class="svg-icon svg-icon-md">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="eye-slash"
                            class="svg-inline--fa fa-eye-slash fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }

                                </style>
                            </defs>
                            <g class="fa-group">
                                <path class="fa-primary"
                                    d="M615.1 512c-5.188 0-10.39-1.651-14.8-5.12L9.188 42.89C-1.234 34.73-3.051 19.63 5.121 9.189c8.188-10.41 23.22-12.29 33.69-4.073l591.1 463.1c10.42 8.156 12.24 23.26 4.068 33.7C630.1 508.8 623.1 512 615.1 512z"
                                    fill="currentColor" />
                                <path class="fa-secondary"
                                    d="M149.2 91.63c49.62-37.69 108.1-59.62 170.8-59.62c122.9 0 230.3 83.53 284.5 206.1c1.906 4.43 3.469 12.05 3.469 17.03c0 4.957-1.562 12.6-3.469 17.03c-19.42 44.19-45.89 83.01-77.21 114.1l-81.27-63.69c11.09-20.4 17.95-43.44 17.95-68.27c0-79.48-64.5-144-143.1-144c-37.29 0-70.83 14.65-96.42 37.93L149.2 91.63zM319.1 160c-2.301 .0293-5.575 .4436-8.461 .7658C316.8 170 319.1 180.6 319.1 192c0 10.17-2.602 19.62-6.821 28.16l94.71 74.24c5.158-11.78 8.114-24.73 8.114-38.4C415.1 203 372.1 160 319.1 160zM319.1 352c-46.96 0-85.92-33.81-94.22-78.37l99.33 77.86C323.4 351.6 321.8 352 319.1 352zM373.6 389.5l74.5 58.4c-39.3 20.65-82.61 32.14-128.1 32.14c-122.9 0-230.3-83.53-284.5-206.1c-1.906-4.43-3.469-12.05-3.469-17.03c0-4.959 1.562-12.6 3.469-17.03c12.54-28.55 28.04-54.84 45.81-78.59l96.72 75.8C177.1 242.7 175.1 249.2 175.1 256c0 79.48 64.53 143.1 144 143.1C338.1 400 356.1 396.1 373.6 389.5z"
                                    fill="currentColor" />
                            </g>
                        </svg>
                    </span>

                    <span class="svg-icon svg-icon-md d-none">
                        <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="eye"
                            class="svg-inline--fa fa-eye fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }

                                </style>
                            </defs>
                            <g class="fa-group">
                                <path class="fa-primary"
                                    d="M288 160C285.7 160 282.4 160.4 279.5 160.8C284.8 170 288 180.6 288 192c0 35.35-28.65 64-64 64C212.6 256 201.1 252.7 192.7 247.5C192.4 250.5 192 253.6 192 256c0 52.1 43 96 96 96s96-42.99 96-95.99S340.1 160 288 160z"
                                    fill="currentColor" />
                                <path class="fa-secondary"
                                    d="M572.5 238.1C518.3 115.5 410.9 32 288 32S57.69 115.6 3.469 238.1C1.563 243.4 0 251 0 256c0 4.977 1.562 12.6 3.469 17.03C57.72 396.5 165.1 480 288 480s230.3-83.58 284.5-206.1C574.4 268.6 576 260.1 576 256C576 251 574.4 243.4 572.5 238.1zM432 256c0 79.45-64.47 144-143.9 144C208.6 400 144 335.5 144 256S208.5 112 288 112S432 176.5 432 256z"
                                    fill="currentColor" />
                            </g>
                        </svg>
                    </span>
                </span>
            </div>

            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
            </div>
        </div>

        <div class="text-muted">
            {{ __('Use 8 or more characters with a mix of letters, numbers & symbols') }}
        </div>
    </div>
    <div class="row mb-10 d-none" id="staff_status_section">
        <div class="col fv-row d-flex justify-content-end">
            <div class="form-check form-switch ">
                <input class="form-check-input" type="checkbox" id="staff_status" checked>
                <label class="form-check-label" for="staff_status">{{ __('Status') }}</label>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Cancelar</button>
        <button type="submit" id="new_staff_button" class="btn btn-primary">
            <span class="indicator-label">{{ __('Save') }}</span>
            <span class="indicator-progress">{{ __('Please wait') }}...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <div></div>
</form>
