<tr>
    <td>{{ $staff->id }}</td>
    <td>
        @can('Edit Staff')
            <a href="{{ route('admin.view_staff', ['id' => $staff->id]) }}" class="mb-1 text-gray-600 text-hover-primary">
                {{ $staff->name }}
            </a>
        @else
            <span class="mb-1 text-gray-600">
                {{ $staff->name }}
            </span>
        @endcan
    </td>
    <td>
        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">
            {{ $staff->email ?? 'NA' }}
        </span>
    </td>
    <td>
        <span
            class="badge badge-light-{{ $staff->is_active == 1 ? 'info' : 'danger' }} fw-bolder me-auto px-4 py-3">{{ $staff->is_active == 1 ? __('Active') : __('Inactive') }}</span>
    </td>
</tr>
