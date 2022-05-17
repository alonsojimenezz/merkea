<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('Tags') }}</h2>
        </div>
    </div>
    <div class="card-body pt-0">
        <input class="form-control" name="product_tags"
            value="{{ isset($product->tags) ? implode(',', $product->tags) : '' }}" id="product_tags" />
        <div class="text-muted fs-7">{{ __('Add tags to product') }}</div>
        @can('Change Product Tags')
            <a id="save_tags_button"
                class="d-none float-end mt-2 btn btn-sm fw-bolder btn-link btn-color-primary btn-active-color-warning">
                <span class="svg-icon svg-icon-muted">
                    <svg aria-hidden="true" focusable="false" data-prefix="fa-solid" data-icon="floppy-disks"
                        class="svg-inline--fa fa-floppy-disks fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path
                            d="M497.9 97.94l-83.88-83.88C406.3 6.294 391.1 0 380.1 0H144C117.5 0 96 21.48 96 48v320C96 394.5 117.5 416 144 416h320c26.5 0 48-21.48 48-48V131.9C512 120.9 505.7 105.7 497.9 97.94zM288 352c-35.34 0-64-28.66-64-64s28.66-64 64-64s64 28.66 64 64S323.3 352 288 352zM384 144C384 152.8 376.8 160 368 160h-192C167.2 160 160 152.8 160 144v-64C160 71.16 167.2 64 176 64h192C376.8 64 384 71.16 384 80V144zM392 512h-272C53.83 512 0 458.2 0 392v-272C0 106.8 10.75 96 24 96S48 106.8 48 120v272c0 39.7 32.3 72 72 72h272c13.25 0 24 10.75 24 24S405.3 512 392 512z"
                            fill="currentColor" />
                    </svg>
                </span>
                {{ __('Save Tags') }}
            </a>
        @endcan
    </div>
</div>
