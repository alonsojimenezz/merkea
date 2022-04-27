<tr>
    <td>{{ $unit->Id }}</td>
    @can('Edit Units of measure')
        <td role="button" class="unit-name-edit-link" data-id="{{ $unit->Id }}">
        @else
        <td>
        @endcan
        <a class="mb-1 text-gray-600 text-hover-primary">
            {{ $unit->Name }}
        </a>
    </td>
    <td>
        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">
            {{ $unit->Key ?? 'NA' }}
        </span>
    </td>
    <td>
        <span
            class="badge badge-light-{{ $unit->Active == 1 ? 'info' : 'danger' }} fw-bolder me-auto px-4 py-3">{{ $unit->Active == 1 ? __('Active') : __('Inactive') }}</span>
    </td>
</tr>
