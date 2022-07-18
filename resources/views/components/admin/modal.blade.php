<div class="modal fade" id="{{ $modal_id ?? 'generic_modal' }}" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            @if (!isset($no_close))
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
            @endif
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                @if (isset($title) || isset($subtitle))
                    <div id="modal_titles" class="mb-13 text-center">
                        @isset($title)
                            <h1 class="mb-3 modal-title-mkea">{{ $title ?? __('Title') }}</h1>
                        @endisset
                        @isset($subtitle)
                            <div class="text-gray-400 fw-bold fs-5">{{ $subtitle ?? __('Subtitle') }}</div>
                        @endisset
                    </div>
                @endif
                @if (isset($alt_title) || isset($alt_subtitle))
                    <div id="modal_alt_titles" class="mb-13 text-center d-none">
                        @isset($alt_title)
                            <h1 class="mb-3">{{ $alt_title ?? __('Title') }}</h1>
                        @endisset
                        @isset($alt_subtitle)
                            <div class="text-gray-400 fw-bold fs-5">{{ $alt_subtitle ?? __('Subtitle') }}</div>
                        @endisset
                    </div>
                @endif
                {{ $body ?? 'Modal body' }}
            </div>
        </div>
    </div>
</div>
