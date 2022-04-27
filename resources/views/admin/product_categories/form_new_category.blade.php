<form id="new_category_form" class="form" action="#">
    <input type="hidden" id="category_id" name="category_id" value="0">
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">{{ __('Category Name') }}</span>
            <span class="svg-icon ms-2" data-bs-toggle="tooltip"
                title="{{ __('Category name should be a grouper for your products') }}">
                <svg aria-hidden="true" focusable="false" data-prefix="fa-solid" data-icon="circle-info"
                    class="svg-inline--fa fa-circle-info fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path
                        d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c17.67 0 32 14.33 32 32c0 17.67-14.33 32-32 32S224 177.7 224 160C224 142.3 238.3 128 256 128zM296 384h-80C202.8 384 192 373.3 192 360s10.75-24 24-24h16v-64H224c-13.25 0-24-10.75-24-24S210.8 224 224 224h32c13.25 0 24 10.75 24 24v88h16c13.25 0 24 10.75 24 24S309.3 384 296 384z"
                        fill="currentColor" />
                </svg>
            </span>
        </label>
        <input id="category_name" name="category_name" type="text" class="form-control form-control-solid"
            placeholder="{{ __('Wines') }}">
    </div>
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="fs-6 fw-bold mb-2">{{ __('Description') }} ({{ __('optional') }})</label>
        <textarea class="form-control form-control-solid" rows="4" id="category_description" name="category_description"
            placeholder="{{ __('Include a good description for your category') }}"></textarea>
    </div>
    <div class="row mb-10">
        <div class="col fv-row">
            <label class="fs-6 fw-bold mb-2">{{ __('Parent category') }} ({{ __('optional') }})</label>
            <select id="parent_category" name="parent_category" class="form-select form-select-solid"
                data-control="select2" data-dropdown-parent="#parent_category_dropdown"
                data-placeholder="{{ __('Chose one option') }}..." data-allow-clear="true">
                <option></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->Id }}">{{ $category->Name }}</option>
                @endforeach
            </select>
            <div id="parent_category_dropdown"></div>
        </div>
    </div>
    <div class="row mb-10" id="category_status_section">
        <div class="col fv-row d-flex justify-content-end">
            <div class="form-check form-switch ">
                <input class="form-check-input" type="checkbox" id="category_status" checked>
                <label class="form-check-label" for="category_status">{{ __('Status') }}</label>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Cancelar</button>
        <button type="submit" id="new_category_button" class="btn btn-primary">
            <span class="indicator-label">{{ __('Save') }}</span>
            <span class="indicator-progress">{{ __('Please wait') }}...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <div></div>
</form>
