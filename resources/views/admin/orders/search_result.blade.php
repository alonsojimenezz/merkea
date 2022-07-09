@isset($products)
    @if (count($products) > 0)
        <div class="table-responsive">
            <table class="table table-striped gy-7 gs-7">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                        <th class="min-w-100px">
                            {{ __('Image') }}
                        </th>
                        <th class="min-w-200px">{{ __('Product') }}</th>
                        <th class="min-w-100px">{{ __('Unit Price') }}</th>
                        <th class="min-w-100px">{{ __('Stock') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a class="symbol symbol-50px">
                                        <span class="symbol-label"
                                            style="background-size: contain; background-image:url({{ isset($p->Image) && $p->Image != '' ? asset($p->Image) : MProduct::product_image($p->Key) }});"></span>
                                    </a>
                                </div>
                            </td>
                            <td>
                                @if ($p->Quantity - $p->QuantitySold > 0)
                                    <a role="button" data-max="{{ $p->Quantity - $p->QuantitySold }}"
                                        data-image="{{ isset($p->Image) && $p->Image != '' ? asset($p->Image) : MProduct::product_image($p->Key) }}"
                                        data-name="{{ $p->Name }}" data-key="{{ $p->Key }}"
                                        data-price="{{ number_format($p->BasePrice - $p->DiscountFixed, 2) }}"
                                        data-branch="{{ $p->BranchId }}" data-granel="{{ $p->Granel }}"
                                        data-id="{{ $p->Id }}"
                                        data-baseprice="{{ number_format($p->BasePrice, 2) }}"
                                        data-discount="{{ number_format($p->DiscountFixed, 2) }}"
                                        class="fw-bolder text-gray-600 text-hover-primary order_product_search">{{ $p->Name }}</a>
                                @else
                                    {{ $p->Name }}
                                @endif
                            </td>
                            <td>${{ number_format($p->BasePrice - $p->DiscountFixed, 2) }}</td>
                            <td class="text-center">{{ $p->Quantity - $p->QuantitySold }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endisset
