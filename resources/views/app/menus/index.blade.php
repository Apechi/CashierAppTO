@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class=" mt-0 mb-4">
            <div class="d-flex justify-content-end">
                <div class=" text-right">
                    <a href="menu/exportpdf" class="btn btn-dark">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                    <a href="menu/export/" class="btn btn-dark">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                    </a>
                    @can('create', App\Models\Menu::class)
                        <a href="" data-bs-toggle="modal" data-bs-target="#ImportExcel" class="btn btn-warning">
                            <i class="bi bi-file-excel"></i> @lang('crud.common.import')
                        </a>
                    @endcan
                    @can('create', App\Models\Menu::class)
                        <a href="{{ route('menus.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.menus.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table id="tableMenu" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.price')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.image')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.type_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                                <tr>
                                    <td>{{ $menu->name ?? '-' }}</td>
                                    <td>{{ $menu->price ?? '-' }}</td>
                                    <td>
                                        <x-partials.thumbnail src="{{ $menu->image ? \Storage::url($menu->image) : '' }}" />
                                    </td>
                                    <td>{{ $menu->description ?? '-' }}</td>
                                    <td>{{ optional($menu->type)->name ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $menu)
                                                <a href="{{ route('menus.edit', $menu) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $menu)
                                                <a href="{{ route('menus.show', $menu) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $menu)
                                                <form action="{{ route('menus.destroy', $menu) }}" method="POST"
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
    <div class="modal fade" id="ImportExcel" tabindex="-1" aria-labelledby="ImportExcelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/menu/import" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ImportExcelLabel">Import Excel</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <a href="{{ asset('assets/format_import/format_import_menu.xlsx') }}">Download Format
                            Di Sini..</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableMenu').DataTable();


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
