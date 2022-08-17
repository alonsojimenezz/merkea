<tr class="odd">
    <td>
        <a href="{{ route('admin.show_order', $order->Id) }}"
            class="text-gray-800 text-hover-primary fw-bolder">{{ MUtils::fullOrderNumber($order->Id) }}</a>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <div class="symbol symbol-circle symbol-35px overflow-hidden me-3">
                <div class="symbol-label fs-5 fw-bolder bg-light-primary text-primary">
                    {{ substr($order->Name, 0, 1) }}</div>
            </div>
            <div class="ms-3">
                <a class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ $order->Name }}</a>
                <div class="text-muted fs-7">{{ $order->Phone }}</div>
            </div>
        </div>
    </td>

    <td class="text-start pe-0" data-order="{{ $order->DeliveryMethod }}">
        <div class="badge badge-{{ $order->DeliveryMethod == 1 ? 'info' : 'danger' }}">
            {{ $order->DeliveryMethod == 1 ? __('Home delivery') : __('Store Pickup') }}</div>
    </td>
    @php
        $date_delivery = $order->DeliveryDate != null && $order->DeliveryDate != '' ? new DateTime($order->DeliveryDate) : '';
        $date_d = $date_delivery != '' ? $date_delivery->format('d/m/Y H:i') : __('As soon as possible');
        $date_c = new DateTime($order->created_at);
        $date_u = new DateTime($order->updated_at);
    @endphp
    <td class="text-start pe-0" data-order="{{ $date_d }}">
        <span class="fs-7">{{ $date_d }}</span>
    </td>
    <td class="text-start pe-0" data-order="{{ $order->BranchName }}">
        <div class="badge badge-light-info">{{ $order->BranchName }}</div>
    </td>
    <td class="text-start pe-0" data-order="{{ __($order->StatusName) }}">
        <div class="badge badge-light-{{ $order->Color }}">{{ __($order->StatusName) }}</div>
    </td>
    <td class="text-start pe-0" data-order="{{ $order->Total }}">
        <span class="fw-bolder">${{ number_format($order->Total, 2) }}</span>
    </td>
    <td class="text-start" data-order="{{ $date_c->format('YmdHis') }}">
        <span class="fw-bolder">{{ $date_c->format('d/m/Y H:i') }}</span>
    </td>
    <td class="text-start" data-order="{{ $date_u->format('YmdHis') }}">
        <span class="fw-bolder">{{ $date_u->format('d/m/Y H:i') }}</span>
    </td>
</tr>
