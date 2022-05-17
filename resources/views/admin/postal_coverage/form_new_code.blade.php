<form id="new_postal_code_form" class="form" action="#">
    <input type="hidden" id="postal_code_id" name="postal_code_id" value="0">
    <div class="row mb-10">
        <div class="col fv-row">
            <label class="fs-6 fw-bold mb-2 required">{{ __('State') }}</label>
            <select id="postal_code_state" name="postal_code_state" class="form-select form-select-solid"
                data-control="select2" data-dropdown-parent="#postal_code_state_dropdown"
                data-placeholder="{{ __('Chose one option') }}..." data-allow-clear="true" data-fv-not-empty="true"
                data-fv-not-empty___message="{{ __('The state is a required field') }}">
                <option></option>
                @foreach ($states as $state)
                    <option value="{{ $state->Id }}">{{ $state->Name }}</option>
                @endforeach
            </select>
            <div id="postal_code_state_dropdown"></div>
        </div>
    </div>

    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">{{ __('City') }}</span>
        </label>
        <input id="postal_code_city" name="postal_code_city" type="text" class="form-control form-control-solid"
            placeholder="{{ __('Naucalpan de Juárez') }}" data-fv-not-empty="true"
            data-fv-not-empty___message="{{ __('The city is a required field') }}">
    </div>

    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">{{ __('Colony') }}</span>
        </label>
        <input id="postal_code_colony" name="postal_code_colony" type="text" class="form-control form-control-solid"
            placeholder="{{ __('Lomas Verdes 1ra Secc') }}" data-fv-not-empty="true"
            data-fv-not-empty___message="{{ __('The colony is a required field') }}">
    </div>

    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
            <span class="required">{{ __('Postal Code') }}</span>
        </label>
        <input id="postal_code" name="postal_code" class="form-control form-control-solid"
            placeholder="53126" data-fv-not-empty="true"
            data-fv-not-empty___message="{{ __('The postal code is a required field') }}">
    </div>

    <div class="row mb-10" id="postal_code_status_section">
        <div class="col fv-row d-flex justify-content-end">
            <div class="form-check form-switch ">
                <input class="form-check-input" type="checkbox" id="postal_code_status" checked>
                <label class="form-check-label" for="postal_code_status">{{ __('Status') }}</label>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Cancelar</button>
        <button type="submit" id="new_postal_code_button" class="btn btn-primary">
            <span class="indicator-label">{{ __('Save') }}</span>
            <span class="indicator-progress">{{ __('Please wait') }}...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <div></div>
</form>
