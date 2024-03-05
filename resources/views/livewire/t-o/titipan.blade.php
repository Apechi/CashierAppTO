<div>
    <div class="container">
        <div class=" mt-0 mb-4">
            <div class="d-flex justify-content-end">
                <div class=" text-right">
                    <a href="" class="btn btn-dark">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                    <a href="" class="btn btn-dark">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                    </a>
                    <a href="" class="btn btn-warning">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.import')
                    </a>
                    @can('create', App\Models\Menu::class)
                        <button data-bs-toggle="modal" data-bs-target="#tambah_titipan" class="btn btn-primary">
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
                                <tr wire:key='produk_titipan-{{ $produk->id }}'>
                                    <td>{{ $produk->nama_produk ?? '-' }}</td>
                                    <td>{{ $produk->nama_supplier ?? '-' }}</td>
                                    <td>{{ $produk->harga_beli }} </td>
                                    <td>{{ $produk->harga_jual ?? '-' }}</td>
                                    <td>{{ $produk->stok ?? '-' }}</td>
                                    <td>{{ $produk->keterangan ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $produk)
                                                <a>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#edit_titipan" data-produk_id="{{ $produk->id }}"
                                                        class="btn btn-light titipan_edit">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $produk)
                                                <a href="{{ route('titipan.show', $produk) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
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
</div>
@script
    <script>
        $(document).ready(function() {
            $('#tableProdukTitipan').DataTable();



        });

        $('.titipan_edit').click(function(e) {

            let id = $(this).data('produk_id');

            console.log(id);

            $wire.dispatch('edit', {
                id: id
            })

        });
    </script>
@endscript
