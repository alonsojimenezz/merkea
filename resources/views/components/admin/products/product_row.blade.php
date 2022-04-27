<tr>
    <td>{{ $product->Id }}</td>
    <td role="button" class="product-name-edit-link" data-id="{{ $product->Id }}">
        <a class="mb-1 text-gray-600 text-hover-primary">
            {{ $product->Key }}
        </a>
    </td>
    <td>
        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">
            {{ $product->Name ?? 'NA' }}
        </span>
    </td>
    <td>
        <span
            class="badge badge-light-{{ $product->Active == 1 ? 'info' : 'danger' }} fw-bolder me-auto px-4 py-3">{{ $product->Active == 1 ? __('Active') : __('Inactive') }}</span>
    </td>
</tr>
