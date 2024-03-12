<div>
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="d-flex justify-content-end">
                <div class="">
                    @can('create', App\Models\Category::class)
                        <a href="category/exportpdf" class="btn btn-dark">
                            <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                        </a>
                        <a href="category/export/" class="btn btn-dark">
                            <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                        </a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#ImportExcel" class="btn btn-warning">
                            <i class="bi bi-file-excel"></i> @lang('crud.common.import')
                        </a>
                        <button type="button" class="btn btn-primary" wire:click='resetField()' data-bs-toggle="modal"
                            data-bs-target="#createCategories">
                            Tambah
                        </button>
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
            <div class="card-body">`
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.categories.index_title')</h4>
                </div>

                <div class="table-responsive" wire:ignore>
                    <table id="tableKategori" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.categories.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.categories.inputs.icon')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr wire:key="anjay-{{ $category->id }}">
                                    <td>{{ $category->name ?? '-' }}</td>
                                    <td>
                                        <button type="none" class="btn btn-light">
                                            <i class="{{ $category->icon ?? '-' }}"></i>
                                        </button>
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $category)
                                                <button wire:click= "edit('{{ $category->id }}')" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#editCategories"
                                                    class="btn btn-light">
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                                @endcan @can('view', $category)
                                                <a href="{{ route('categories.show', $category) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $category)
                                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
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
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @include('livewire.categories-form')
        @include('livewire.categories-edit')
    </div>
    <div class="modal fade" id="ImportExcel" tabindex="-1" aria-labelledby="ImportExcelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/category/import" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ImportExcelLabel">Import Excel</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $(document).ready(function() {
            $('#tableKategori').DataTable();

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
@endscript
