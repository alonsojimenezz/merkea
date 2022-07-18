<div class="row py-4 px-2">
    <div class="col-12">
        <h3 class="fs-5 text-center text-uppercase">{{ __('Welcome to Merkea Minimarket Online') }}</h3>
    </div>
    <div class="col-12 mt-30">
        <h3 class="fs-6 text-center">{{ __('Please select a branch') }}</h3>
        <select id="global_branch_select" class="form-control nonice">
            <option class="text-gray-500">{{ __('Branches...') }}</option>
            @foreach ($branches_global as $branch)
                <option value="{{ $branch->Id }}">{{ $branch->Name }}</option>
            @endforeach
        </select>
        <h3 class="fs-6 text-center mt-40">{{ __('or select a postal code') }}</h3>
        <select id="global_postal_code_select" class="form-control nonice">
            <option class="text-gray-500">{{ __('Postal codes...') }}</option>
            @foreach ($postal_codes_global as $code)
                <option value="{{ $code->BranchId }}">{{ $code->PostalCode . ' - ' . $code->Colony }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 mt-30">
        <div class="alert alert-warning d-flex align-items-center mt-5" role="alert">
            <div class="ps-2">
                {{ __("We are working to improve our coverage. If you can't find your zip code, choose your nearest branch") }}
            </div>
        </div>
    </div>
</div>
