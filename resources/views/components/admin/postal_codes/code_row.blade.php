<tr>
    <td>{{ $code->Id }}</td>
    @can('Edit Postal Code Coverage')
        <td role="button" class="postal_code-name-edit-link" data-id="{{ $code->Id }}">
        @else
        <td>
        @endcan
        <a class="mb-1 text-gray-600 text-hover-primary">
            {{ $code->PostalCode }}
        </a>
    </td>
    <td>{{ $code->State }}</td>
    <td>{{ $code->City }}</td>
    <td>{{ $code->Colony }}</td>
    <td>
        <span
            class="badge badge-light-{{ $code->IsActive == 1 ? 'info' : 'danger' }} fw-bolder me-auto px-4 py-3">{{ $code->IsActive == 1 ? __('Active') : __('Inactive') }}</span>
    </td>
</tr>
