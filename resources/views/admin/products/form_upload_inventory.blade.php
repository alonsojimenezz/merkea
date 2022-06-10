<form id="upload_inventory_form" class="form" action="#">
    <div class="row mb-10">
        <div class="col fv-row">
            <label class="fs-6 fw-bold mb-2">{{ __('Branch Office') }}</label>
            <select id="branch_inventory" name="branch_inventory" class="form-select form-select-solid"
                data-control="select2" data-dropdown-parent="#branch_inventory_dropdown"
                data-placeholder="{{ __('Chose one option') }}..." data-allow-clear="true">
                <option></option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->Id }}">{{ $branch->Name }}</option>
                @endforeach
            </select>
            <div id="branch_inventory_dropdown"></div>
        </div>
    </div>
    <div class="row dropzone_containter mb-10">
        <div class="dropzone" id="upload_inventory_dz">
            <div class="dz-message needsclick">
                <span class="svg-icon svg-icon-3x svg-icon-warning ">
                    <svg aria-hidden="true" focusable="false" data-prefix="fa-solid" data-icon="file-arrow-up"
                        class="svg-inline--fa fa-file-arrow-up fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512">
                        <path
                            d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM288.1 344.1C284.3 349.7 278.2 352 272 352s-12.28-2.344-16.97-7.031L216 305.9V408c0 13.25-10.75 24-24 24s-24-10.75-24-24V305.9l-39.03 39.03c-9.375 9.375-24.56 9.375-33.94 0s-9.375-24.56 0-33.94l80-80c9.375-9.375 24.56-9.375 33.94 0l80 80C298.3 320.4 298.3 335.6 288.1 344.1z"
                            fill="currentColor" />
                    </svg>
                </span>
                <div class="ms-4">
                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                        {{ __('Drop the file here or click to upload') }}</h3>
                    <span class="fs-7 fw-bold text-gray-400">{{ __('Only a file with an xlsx extension is accepted') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Cancelar</button>
        <button type="submit" id="upload_inventory_button" class="btn btn-primary">
            <span class="indicator-label">{{ __('Save') }}</span>
            <span class="indicator-progress">{{ __('Please wait') }}...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <div class="my-10 py-10"></div>
</form>
