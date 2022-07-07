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
            </div>
        </div>
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
    @php
        $date_c = new DateTime($order->created_at);
        $date_u = new DateTime($order->updated_at);
    @endphp
    <td class="text-start" data-order="{{ $date_c->format('d/m/Y H:i') }}">
        <span class="fw-bolder">{{ $date_c->format('d/m/Y H:i') }}</span>
    </td>
    <td class="text-start" data-order="{{ $date_u->format('d/m/Y H:i') }}">
        <span class="fw-bolder">{{ $date_u->format('d/m/Y H:i') }}</span>
    </td>
</tr>
