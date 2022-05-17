<form id="new_branch_office_form" class="form" action="#">
    <input type="hidden" id="branch_office_id" name="branch_office_id" value="0">
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">{{ __('Branch Office Name') }}</span>
        </label>
        <input id="branch_office_name" name="branch_office_name" type="text" class="form-control form-control-solid"
            placeholder="{{ __('MERKEA Mini Market Gourmet') }}" data-fv-not-empty="true"
            data-fv-not-empty___message="{{ __('Branch Office Name is a required field') }}">
    </div>
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="fs-6 fw-bold mb-2 required">{{ __('Branch Office Address') }}</label>
        <textarea class="form-control form-control-solid" rows="4" id="branch_office_address" name="branch_office_address"
            placeholder="General Agustín de Iturbide, Sexta 2-Local 3.1, Lomas Verdes 1ra Secc, 53126 Naucalpan de Juárez, Méx."
            data-fv-not-empty="true"
            data-fv-not-empty___message="{{ __('Branch Office Address is a required field') }}"></textarea>
    </div>
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="fs-6 fw-bold mb-2">{{ __('Google Maps Insert Code') }} ({{ __('optional') }})</label>
        <textarea class="form-control form-control-solid" rows="4" id="branch_office_google_maps_code"
            name="branch_office_google_maps_code" placeholder="{{ __('<iframe>...</iframe>') }}"></textarea>
    </div>
    <div class="row mb-10" id="branch_office_status_section">
        <div class="col fv-row d-flex justify-content-end">
            <div class="form-check form-switch ">
                <input class="form-check-input" type="checkbox" id="branch_office_status" checked>
                <label class="form-check-label" for="branch_office_status">{{ __('Status') }}</label>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Cancelar</button>
        <button type="submit" id="new_branch_office_button" class="btn btn-primary">
            <span class="indicator-label">{{ __('Save') }}</span>
            <span class="indicator-progress">{{ __('Please wait') }}...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <div></div>
</form>
