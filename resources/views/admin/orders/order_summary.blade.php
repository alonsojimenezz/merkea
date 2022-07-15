<div class="tab-pane fade active show" id="order_summary_tab" role="tab-panel">
    <div class="d-flex flex-column gap-7 gap-lg-10">
        @if ($order->DeliveryMethod == 1)
            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12 col-md-3 pt-4 text-gray-300">
                                <svg aria-hidden="true" width="200" focusable="false" data-prefix="fa-duotone"
                                    data-icon="truck-fast" class="svg-inline--fa fa-truck-fast fa-w-20" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M624 352H608V237.3c0-17.09-6.65-33.15-18.74-45.24l-77.26-77.26C500.1 102.8 483.6 96 466.8 96H416V48C416 21.5 394.5 0 368 0H109.8c-26.5 0-48 21.5-48 48V96H272C280.8 96 288 103.2 288 112S280.8 128 272 128H61.84v32H240C248.8 160 256 167.2 256 176S248.8 192 240 192H61.84v32H208C216.8 224 224 231.2 224 240S216.8 256 208 256H61.84v112c0 10.25 3.277 19.7 8.756 27.5C85.79 351.7 126.1 320 176 320c56.38 0 102.6 41.79 110.4 96h67.23C361.5 361.9 407.7 320 464 320c56.22 0 101.1 41.93 109.8 96H624c8.812 0 16-7.203 16-16v-32C640 359.2 632.8 352 624 352zM544 256h-128V160h50.75L544 237.3V256z"
                                            fill="currentColor" />
                                        <path class="fa-secondary"
                                            d="M176 352C131.8 352 96 387.8 96 432C96 476.2 131.8 512 176 512S256 476.2 256 432C256 387.8 220.2 352 176 352zM464 352c-44.18 0-80 35.82-80 80c0 44.18 35.82 80 80 80s80-35.82 80-80C544 387.8 508.2 352 464 352zM240 160h-192C39.16 160 32 167.2 32 176S39.16 192 47.1 192h192C248.8 192 256 184.8 256 176S248.8 160 240 160zM224 240C224 231.2 216.8 224 208 224h-192C7.164 224 0 231.2 0 240S7.164 256 15.1 256h192C216.8 256 224 248.8 224 240zM272 96h-256C7.164 96 0 103.2 0 111.1S7.164 128 15.1 128h256C280.8 128 288 120.8 288 112S280.8 96 272 96z"
                                            fill="currentColor" />
                                    </g>
                                </svg>
                            </div>
                            <div class="col-12 col-md-9 pt-4 fs-4">
                                <div class="card-title mb-10">
                                    <h2>{{ __('Shipping Address') }}</h2>
                                </div>
                                {{ $order->Address ?? __('No Address Registered') }}
                                <br>{{ $order->PostalCode->PostalCode . ' - ' . $order->PostalCode->Colony }},
                                <br>{{ $order->PostalCode->City ?? __('No City Registered') }},
                                <br>{{ $order->PostalCode->State->Name ?? __('No State Registered') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('Order') . ' ' . MUtils::fullOrderNumber($order->Id) }}</h2>
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    @can('Edit Order')
                        @if ($order->StatusId == 1)
                            <a role="button" id="add_order_item" data-bs-toggle="modal" data-bs-target="#modal_add_product"
                                class="btn btn-primary">{{ __('Add Product') }}</a>
                        @endif
                    @endcan
                </div>
            </div>
            <div class="card-body pt-4">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-175px">{{ __('Product') }}</th>
                                <th class="min-w-100px text-end">{{ __('Product Key') }}</th>
                                <th class="min-w-70px text-end">{{ __('Qty') }}</th>
                                <th class="min-w-100px text-end">{{ __('Unit Price') }}</th>
                                <th class="min-w-100px text-end">{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            @php
                                $total = 0;
                            @endphp
                            @isset($order->Items)
                                @foreach ($order->Items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a class="symbol symbol-50px">
                                                    <span class="symbol-label"
                                                        style="background-size: contain; background-image:url({{ isset($item->Image) && $item->Image != '' ? asset($item->Image) : MProduct::product_image($item->Key) }});"></span>
                                                </a>
                                                <div class="ms-5">
                                                    @can('Edit Order')
                                                        @if ($order->StatusId == 1)
                                                            <a role="button" data-id="{{ $item->Id }}"
                                                                class="fw-bolder text-gray-600 text-hover-primary order_product">{{ $item->ProductName }}</a>
                                                        @else
                                                            <span
                                                                class="fw-bolder text-gray-600">{{ $item->ProductName }}</span>
                                                        @endif
                                                    @else
                                                        <span class="fw-bolder text-gray-600">{{ $item->ProductName }}</span>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">{{ $item->Key }}</td>
                                        <td class="text-end">{{ $item->Quantity }}</td>
                                        @php
                                            $unit_price = $item->BasePrice - $item->Discount;
                                            $total += $unit_price * $item->Quantity;
                                        @endphp
                                        <td class="text-end">${{ number_format($unit_price, 2) }}</td>
                                        <td class="text-end">
                                            ${{ number_format($unit_price * $item->Quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                            <tr>
                                <td colspan="4" class="text-end">{{ __('Subtotal') }}</td>
                                <td class="text-end">${{ number_format($total, 2) }}</td>
                            </tr>
                            {{-- <tr>
                                <td colspan="4" class="text-end">VAT (0%)</td>
                                <td class="text-end">$0.00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end">Shipping Rate</td>
                                <td class="text-end">$5.00</td>
                            </tr> --}}
                            <tr>
                                <td colspan="4" class="fs-3 text-dark text-end">
                                    {{ __('Grand Total') }}</td>
                                <td class="text-dark fs-3 fw-boldest text-end">
                                    ${{ number_format($total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
