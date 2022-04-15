<tr>
    <td>{{ $category->Id }}</td>
    <td>
        <a role="button" class="mb-1 text-gray-600 text-hover-primary category-name-edit-link" data-id="{{ $category->Id }}">
            {{ $category->Name }}
        </a>
    </td>
    <td>
        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">
            {{ $category->ParentName ?? 'NA' }}
        </span>
    </td>
    <td>
        <span
            class="badge badge-light-{{ $category->Active == 1 ? 'info' : 'danger' }} fw-bolder me-auto px-4 py-3">{{ $category->Active == 1 ? __('Active') : __('Inactive') }}</span>
    </td>
</tr>
