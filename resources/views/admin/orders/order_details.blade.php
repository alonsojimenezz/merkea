<div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
    <div class="card card-flush py-4 flex-row-fluid">
        <div class="card-header">
            <div class="card-title">
                <h2>{{ __('Order Details') }} ({{ MUtils::fullOrderNumber($order->Id) }})</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                    <tbody class="fw-bold text-gray-600">
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                    <span class="svg-icon svg-icon-2 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21"
                                            viewBox="0 0 20 21" fill="none">
                                            <path opacity="0.3"
                                                d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z"
                                                fill="black"></path>
                                            <path
                                                d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    {{ __('Date Added') }}
                                </div>
                            </td>
                            <td class="fw-bolder text-end">{{ $order->Added->format('d/m/Y  H:i') }}</td>
                        </tr>
                        @if ($order->Added != $order->Updated)
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21"
                                                viewBox="0 0 20 21" fill="none">
                                                <path opacity="0.3"
                                                    d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                        {{ __('Date Modified') }}
                                    </div>
                                </td>
                                <td class="fw-bolder text-end">{{ $order->Updated->format('d/m/Y  H:i') }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-muted">
                                @if ($order->DeliveryMethod == 1)
                                    <svg aria-hidden="true" width="22" focusable="false" data-prefix="fa-solid"
                                        data-icon="person-biking-mountain"
                                        class="svg-inline--fa fa-person-biking-mountain fa-w-20" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path
                                            d="M400 96C426.5 96 448 74.5 448 48S426.5 0 400 0S352 21.5 352 48S373.5 96 400 96zM172.8 170.1C178.4 177 188.1 178 194.5 172.4L298.8 83.5c6.375-5.5 7-15.5 1.375-22.38C272 27.25 223.2 22.12 191.4 49.88L133.3 98.63C126.9 104.2 126.2 114.1 131.9 121L172.8 170.1zM240 352H234.8c-2.125-7.25-4.1-14.25-8.625-20.88l3.75-3.625c6.25-6.25 6.25-16.5 0-22.75L207.3 282.1c-6.25-6.25-16.5-6.25-22.75 0L180.9 285.9C174.2 282.2 167.2 279.4 160 277.3V272C160 263.1 152.9 256 144 256h-32C103.1 256 96 263.1 96 272v5.25c-7.25 2.125-14.25 4.1-20.88 8.625L71.5 282.1c-6.25-6.25-16.48-6.25-22.72 0L26.15 304.8c-6.25 6.25-6.25 16.5 0 22.75l3.725 3.625C26.25 337.8 23.38 344.8 21.25 352H16C7.125 352 0 359.1 0 368v32C0 408.9 7.125 416 16 416h5.25c2.125 7.25 4.1 14.25 8.625 20.88L26.12 440.5c-6.25 6.25-6.25 16.5 0 22.75l22.63 22.62c6.25 6.25 16.47 6.25 22.72 0l3.65-3.75C81.75 485.8 88.75 488.6 96 490.8V496C96 504.9 103.1 512 112 512h32C152.9 512 160 504.9 160 496v-5.25c7.25-2.125 14.25-4.1 20.88-8.625l3.675 3.75c6.25 6.25 16.45 6.25 22.7 0l22.62-22.62c6.25-6.25 6.25-16.5 0-22.75l-3.75-3.625C229.8 430.2 232.6 423.2 234.8 416H240C248.9 416 256 408.9 256 400v-32C256 359.1 248.9 352 240 352zM128 448c-35.38 0-64-28.62-64-64s28.62-64 64-64s64 28.62 64 64S163.4 448 128 448zM624 352h-5.25c-2.125-7.25-5-14.25-8.625-20.88l3.75-3.625c6.25-6.25 6.25-16.5 0-22.75l-22.62-22.62c-6.25-6.25-16.5-6.25-22.75 0l-3.625 3.75C558.3 282.2 551.3 279.4 544 277.3V272C544 263.1 536.9 256 528 256h-32C487.1 256 480 263.1 480 272v5.25c-7.25 2.125-14.25 4.1-20.88 8.625L455.5 282.1c-6.25-6.25-16.4-6.25-22.65 0l-22.6 22.62c-6.25 6.25-6.25 16.5 0 22.75l3.625 3.625C410.2 337.8 407.4 344.8 405.3 352H400c-8.875 0-16 7.125-16 16v32c0 8.875 7.125 16 16 16h5.25c2.125 7.25 4.1 14.25 8.625 20.88l-3.75 3.625c-6.25 6.25-6.25 16.5 0 22.75l22.62 22.62c6.25 6.25 16.47 6.25 22.73 0l3.65-3.75C465.8 485.8 472.8 488.6 480 490.8V496c0 8.875 7.125 16 16 16h32c8.875 0 16-7.125 16-16v-5.25c7.25-2.125 14.25-4.1 20.88-8.625l3.75 3.75c6.25 6.25 16.38 6.25 22.62 0l22.62-22.62c6.25-6.25 6.25-16.5 0-22.75l-3.75-3.625C613.8 430.2 616.6 423.2 618.8 416H624c8.875 0 16-7.125 16-16v-32C640 359.1 632.9 352 624 352zM512 448c-35.38 0-64-28.62-64-64s28.62-64 64-64s64 28.62 64 64S547.4 448 512 448zM396 217C401.6 221.5 408.8 224 416 224h64c17.62 0 32-14.38 32-32s-14.38-32-32-32h-52.75L356 103c-12-9.625-29.12-9.375-40.75 .625l-112 96c-7.625 6.625-11.75 16.25-11.12 26.25c.5 10 5.75 19.12 14.12 24.75L288 305.1V416c0 17.62 14.38 32 32 32s32-14.38 32-32V288c0-10.75-5.375-20.62-14.25-26.62L296.4 233.8l58.25-49.88L396 217z"
                                            fill="currentColor" />
                                    </svg>
                                @elseif($order->DeliveryMethod == 2)
                                    <svg aria-hidden="true" width="22" focusable="false" data-prefix="fa-solid"
                                        data-icon="shop" class="svg-inline--fa fa-shop fa-w-20" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path
                                            d="M319.1 384H127.1V224H63.98L63.97 480c0 17.75 14.25 32 32 32h256c17.75 0 32-14.25 32-32l.0114-256H319.1V384zM634.6 142.2l-85.38-128c-6-9-16-14.25-26.63-14.25H117.3c-10.63 0-20.63 5.25-26.63 14.25l-85.25 128C-8.78 163.5 6.47 192 32.1 192h575.9C633.5 192 648.7 163.5 634.6 142.2zM511.1 496c0 8.75 7.25 16 16 16h32.01c8.75 0 16-7.25 16-16L575.1 224h-64.01L511.1 496z"
                                            fill="currentColor" />
                                    </svg>
                                @endif
                                {{ __('Method of delivery') }}
                            </td>
                            <td class="fw-bolder text-end">
                                @if ($order->DeliveryMethod == 1)
                                    {{ __('Home delivery') }}
                                @elseif($order->DeliveryMethod == 2)
                                    {{ __('Store Pickup') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <svg aria-hidden="true" width="22" focusable="false" data-prefix="fa-solid"
                                    data-icon="calendar-clock" class="svg-inline--fa fa-calendar-clock fa-w-18"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M448 112C448 85.49 426.5 64 400 64H352V31.1C352 14.4 337.6 0 320 0C302.4 0 288 14.4 288 31.1V64H160V31.1C160 14.4 145.6 0 128 0S96 14.4 96 31.1V64H48C21.49 64 0 85.49 0 112V160h448V112zM432 224C352.4 224 288 288.4 288 368s64.38 144 144 144S576 447.6 576 368S511.6 224 432 224zM480 384h-54.25C420.4 384 416 379.6 416 374.3V304C416 295.2 423.2 288 432 288C440.8 288 448 295.2 448 304V352h32c8.838 0 16 7.162 16 16C496 376.8 488.8 384 480 384zM256 368C256 270.8 334.8 192 432 192H0v272C0 490.5 21.5 512 48 512h283C285.7 480.2 256 427.6 256 368z"
                                        fill="currentColor" />
                                </svg>
                                {{ __('Schedule Delivery / Pickup') }}
                            </td>
                            <td class="fw-bolder text-end">
                                @if ($order->DeliveryDate != null && $order->DeliveryDate != '')
                                    @php
                                        $date = new DateTime($order->DeliveryDate);
                                    @endphp
                                    <strong>{{ $date->format('d/m/Y') }}</strong> {{ __('from') }}
                                    <strong>{{ $date->format('H:i') }}</strong> hrs
                                @else
                                    {{ __('As soon as possible') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                    <span class="svg-icon svg-icon-2 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z"
                                                fill="black"></path>
                                            <path opacity="0.3"
                                                d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z"
                                                fill="black"></path>
                                            <path
                                                d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    {{ __('Payment Method') }}
                                </div>
                            </td>
                            <td class="fw-bolder text-end">
                                @if ($order->PaymentMethodId == 1)
                                    {{ __('Cash on delivery') }}
                                @elseif($order->PaymentMethodId == 2)
                                    {{ __('Credit/Debit Card on Delivery') }}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card card-flush py-4 flex-row-fluid">
        <div class="card-header">
            <div class="card-title">
                <h2>{{ __('Customer Details') }}</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                    <tbody class="fw-bold text-gray-600">
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                    <span class="svg-icon svg-icon-2 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                fill="black"></path>
                                            <path
                                                d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    {{ __('Customer') }}
                                </div>
                            </td>
                            <td class="fw-bolder text-end">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="symbol symbol-circle symbol-35px overflow-hidden me-3">
                                        <div class="symbol-label fs-5 fw-bolder bg-light-primary text-primary">
                                            {{ substr($order->Name, 0, 1) }}</div>
                                    </div>
                                    <a href="/craft/apps/ecommerce/customers/details.html"
                                        class="text-gray-600 text-hover-primary">{{ $order->Name }}</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                    <span class="svg-icon svg-icon-2 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                fill="black"></path>
                                            <path
                                                d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    {{ __('Email') }}
                                </div>
                            </td>
                            <td class="fw-bolder text-end">
                                <a href="/craft/apps/user-management/users/view.html"
                                    class="text-gray-600 text-hover-primary">{{ $order->Email ?? __('No Email Registered') }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">
                                    <span class="svg-icon svg-icon-2 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z"
                                                fill="black"></path>
                                            <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="black">
                                            </path>
                                        </svg>
                                    </span>
                                    {{ __('Phone') }}
                                </div>
                            </td>
                            <td class="fw-bolder text-end">
                                {{ $order->Phone ?? __('No Phone Registered') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
