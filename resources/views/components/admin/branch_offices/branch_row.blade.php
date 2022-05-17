<tr>
    <td>{{ $branch->Id }}</td>
    @can('Edit Branch Office')
        <td role="button" class="branch_office-name-edit-link" data-id="{{ $branch->Id }}">
        @else
        <td>
        @endcan
        <a class="mb-1 text-gray-600 text-hover-primary">
            {{ $branch->Name }}
        </a>
    </td>
    <td>
        <span
            class="badge badge-light-{{ $branch->IsActive == 1 ? 'info' : 'danger' }} fw-bolder me-auto px-4 py-3">{{ $branch->IsActive == 1 ? __('Active') : __('Inactive') }}</span>
    </td>
</tr>
