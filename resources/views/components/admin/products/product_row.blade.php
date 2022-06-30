<tr>
    <td>{{ $product->Id }}</td>
    <td role="button" class="product-name-edit-link">
        <a target="_blank"
            href="{{ Route::has('admin.show_product') ? route('admin.show_product', ['id' => $product->Id]) : '#' }}"
            class="mb-1 text-gray-600 text-hover-primary">
            {{ $product->Key }}
        </a>
    </td>
    <td>
        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">
            {{ $product->Name ?? 'NA' }}
        </span>
    </td>
    <td>
        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">
            {{ $product->DepartmentName ?? 'NA' }}
        </span>
    </td>
    <td>
        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">
            {{ $product->CategoryName ?? 'NA' }}
        </span>
    </td>
    <td>
        <span
            class="badge badge-light-{{ $product->Active == 1 ? 'info' : 'danger' }} fw-bolder me-auto px-4 py-3">{{ $product->Active == 1 ? __('Active') : __('Inactive') }}</span>
    </td>
</tr>
