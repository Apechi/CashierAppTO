<div>
    <div class="container">
        <div class=" mt-0 mb-4">
            <div class="d-flex justify-content-end">
                <div class=" text-right">
                    <a href="produktitip/exportpdf" class="btn btn-dark">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                    <a href="produktitip/export" class="btn btn-dark">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#ImportExcel" class="btn btn-warning">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.import')
                    </a>
                    @can('create', App\Models\Menu::class)
                        <button data-bs-toggle="modal" wire:click='resetField()' data-bs-target="#tambah_titipan"
                            class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.titipan.index_title')</h4>
                </div>

                <div class="table-responsive" wire:ignore>
                    <table id="tableProdukTitipan" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.titipan.inputs.nama_produk')
                                </th>
                                <th class="text-left">
                                    @lang('crud.titipan.inputs.nama_supplier')
                                </th>
                                <th class="text-left">
                                    @lang('crud.titipan.inputs.harga_beli')
                                </th>
                                <th class="text-left">
                                    @lang('crud.titipan.inputs.harga_jual')
                                </th>
                                <th class="text-left">
                                    @lang('crud.titipan.inputs.stok')
                                </th>
                                <th class="text-left">
                                    @lang('crud.titipan.inputs.keterangan')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkTitipan as $produk)
                                <tr wire:key='produktitipan-{{ $produk->id }}'>
                                    <td>{{ $produk->nama_produk ?? '-' }}</td>
                                    <td>{{ $produk->nama_supplier ?? '-' }}</td>
                                    <td>{{ $produk->harga_beli }} </td>
                                    <td>{{ $produk->harga_jual ?? '-' }}</td>
                                    <td>
                                        <p class="stok_field" data-produk_id="{{ $produk->id }}">
                                            {{ $produk->stok ?? '-' }}</p>
                                    </td>
                                    <td>{{ $produk->keterangan ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $produk)
                                                <a>
                                                    <button type="button" wire:click='edit({{ $produk->id }})'
                                                        data-bs-toggle="modal" data-bs-target="#edit_titipan"
                                                        data-produk_id="{{ $produk->id }}"
                                                        class="btn btn-light titipan_edit">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $produk)
                                                <form action="{{ route('titipan.destroy', $produk) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
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

    @include('livewire.t-o.create')
    @include('livewire.t-o.edit')

    <div class="modal fade" id="ImportExcel" tabindex="-1" aria-labelledby="ImportExcelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/produktitip/import" method="POST" enctype="multipart/form-data">
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
            $('#tableProdukTitipan').DataTable();

        });

        $(document).ready(function() {
            let id_produk = 0;

            $('.stok_field').dblclick(function() {
                var currentValue = $(this).text().trim();
                var id = $(this).data('produk_id');

                id_produk = id;

                var inputElement = $('<input type="number">');
                inputElement.val(currentValue);
                inputElement.blur(function() { // Attach blur event handler here
                    var newValue = $(this).val().trim();
                    var paragraphElement = $('<p id="editableParagraph">').text(newValue);

                    $(this).replaceWith(paragraphElement);

                    $wire.dispatch('edit_stok', {
                        id: id_produk,
                        stok: newValue
                    });
                });

                $(this).replaceWith(inputElement);
                inputElement.focus(); // Optionally focus the input element
            });
        });




        $('.titipan_edit').click(function(e) {

            let id = $(this).data('produk_id');

            $wire.dispatch('edit', {
                id: id
            })

        });
    </script>
@endscript
