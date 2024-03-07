@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="d-flex justify-content-end">

                <div class="text-right">
                    @can('create', App\Models\Permission::class)
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">
                        @lang('crud.permissions.index_title')
                    </h4>
                </div>

                <div class="table-responsive">
                    <table id="tablePermission" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.permissions.inputs.name')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $permission)
                                                <a href="{{ route('permissions.edit', $permission) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $permission)
                                                <a href="{{ route('permissions.show', $permission) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $permission)
                                                <form action="{{ route('permissions.destroy', $permission) }}" method="POST"
                                                    class="delete-form">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tablePermission').DataTable();
        });

        $('.delete-form').submit(function(event) {
            event.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "{{ __('crud.common.are_you_sure') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33', // Mengubah warna tombol konfirmasi menjadi merah
                cancelButtonColor: '#3085d6', // Mengubah warna tombol cancel menjadi biru
                confirmButtonText: 'Ya, Hapus item ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    $(this).unbind('submit').submit();
                }
            });
        });
    </script>
@endpush
