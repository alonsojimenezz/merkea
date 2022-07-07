<div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-lg-n2 me-auto">
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                href="#order_summary_tab">{{ __('Order Summary') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                href="#order_history_tab">{{ __('Order History') }}</a>
        </li>
    </ul>

    <button type="button" class="btn btn-{{ $order->Status->Color }}" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-start">
        {{ __($order->Status->Name) }}
        <span class="svg-icon svg-icon-5 rotate-180 ms-3 me-0">
            <svg aria-hidden="true" focusable="false" data-prefix="fa-solid" data-icon="caret-down"
                class="svg-inline--fa fa-caret-down fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 320 512">
                <path
                    d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z"
                    fill="currentColor" />
            </svg>
        </span>
    </button>

    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
        data-kt-menu="true">
        @foreach ($status as $s)
            @if ($order->Status->Id != $s->Id)
                <div class="menu-item px-3">
                    <a role="button" data-order="{{ $order->Id }}" data-status="{{ $s->Id }}"
                        class="menu-link px-3 status_order_change">
                        {{ __($s->Name) }}
                    </a>
                </div>
            @endif
        @endforeach
    </div>

    {{-- <select id="order_status" class="form-select" style="width: 40% !important" data-dropdown-css-class="w-200px"
        data-control="select2" data-placeholder="Select an option" data-hide-search="true">
        <option></option>
        @foreach ($status as $s)
            <option class="text-{{ $s->Color }}" value="{{ $s->Id }}"
                {{ $order->StatusId == $s->Id ? 'selected' : '' }}>
                {{ __($s->Name) }}</option>
        @endforeach
    </select> --}}
</div>
