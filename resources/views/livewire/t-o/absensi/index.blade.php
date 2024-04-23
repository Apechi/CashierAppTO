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
                    <a href="" data-bs-toggle="modal" data-bs-target="#ImportExcel" class="btn btn-warning">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.import')
                    </a>
                    @can('create', App\Models\Menu::class)
                        <button data-bs-toggle="modal" data-bs-target="#tambah_absensi" wire:click='resetField()'
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
                    <h4 class="card-title">@lang('crud.absensi.index_title')</h4>
                </div>

                <div class="table-responsive" wire:ignore>
                    <table id="tableAbsensiKaryawan" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.absensi.inputs.nama_karyawan')
                                </th>
                                <th class="text-left">
                                    @lang('crud.absensi.inputs.tanggal_masuk')
                                </th>
                                <th class="text-left">
                                    @lang('crud.absensi.inputs.waktu_masuk')
                                </th>
                                <th class="text-left">
                                    @lang('crud.absensi.inputs.waktu_keluar')
                                </th>
                                <th class="text-left">
                                    @lang('crud.absensi.inputs.status')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensiKaryawan as $absensi)
                                <tr wire:key='absensi-{{ $absensi->id }}'>
                                    <td>{{ $absensi->namaKaryawan ?? '-' }}</td>
                                    <td>{{ $absensi->tanggalMasuk ?? '-' }}</td>
                                    <td>{{ $absensi->waktuMasuk ?? '-' }} </td>
                                    <td>{{ $absensi->waktuKeluar ?? '-' }}</td>
                                    <td>{{ $absensi->status ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $absensi)
                                                <a>
                                                    <button type="button" wire:click='edit({{ $absensi->id }})'
                                                        data-bs-toggle="modal" data-bs-target="#edit_titipan"
                                                        data-absensi_id="{{ $absensi->id }}" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('delete', $absensi)
                                                <form action="{{ route('absensi.destroy', $absensi) }}" method="POST"
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

    <div class="modal fade" id="ImportExcel" wire:ignore tabindex="-1" aria-labelledby="ImportExcelLabel"
        aria-hidden="true">
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

    @include('livewire.t-o.absensi.create')

</div>

@script
    <script>
        $(document).ready(function() {
            $('#tableAbsensiKaryawan').DataTable();

        });
    </script>
@endscript
