<div class="d-none toast-container-main {{$position ?? 'top-0 end-0'}} p-3 z-index-100">
    <div id="main_toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <div class="symbol symbol-20px">
                <div class="symbol-label" style="background-image: url({{ asset('ico/apple-icon-180x180.png') }})">
                </div>
            </div>
            <strong class="me-auto ms-3" id="main_toast_title"></strong>
            <small id="main_toast_subtitle"></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="main_toast_body">
        </div>
    </div>
</div>
