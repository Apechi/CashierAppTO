<div>
    <div class="container">
        <div class=" mt-0 mb-4">
            <div class="d-flex justify-content-end">
                <div class=" text-right">
                    <a href="karyawanabsensi/exportpdf" class="btn btn-dark">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                    <a href="karyawanabsensi/export" class="btn btn-dark">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#ImportExcel" class="btn btn-warning">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.import')
                    </a>
                    @can('create', App\Models\Menu::class)
                        <button data-bs-toggle="modal" wire:click='clearInput' data-bs-target="#absensi_tambah"
                            class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
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
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">Absensi Kerja Karyawan</h4>
                </div>

                <div class="table-responsive" wire:ignore>
                    <table id="tableAbsensi" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    Nama Karyawan
                                </th>
                                <th class="text-left">
                                    Tanggal Masuk
                                </th>
                                <th class="text-left">
                                    Waktu Masuk
                                </th>
                                <th class="text-left">
                                    Status
                                </th>
                                <th class="text-left">
                                    Waktu Keluar
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
                                    <td> <select class="form-select" name="status"
                                            wire:change="updateStatus('{{ $absensi->id }}', $event.target.value)">
                                            <option value="sakit" @if ($absensi->status == 'sakit') selected @endif>
                                                Sakit</option>
                                            <option value="cuti" @if ($absensi->status == 'cuti') selected @endif>
                                                Cuti</option>
                                            <option value="masuk" @if ($absensi->status == 'masuk') selected @endif>
                                                Masuk</option>
                                        </select> </td>
                                    <td>
                                        @if ($absensi->status === 'masuk')
                                            @if ($absensi->waktuKeluar == '00:00:00')
                                                <button type="button"
                                                    wire:click="updateWaktuKeluar('{{ $absensi->id }}')"
                                                    class="btn btn-primary">Selesai</button>
                                            @else
                                                {{ $absensi->waktuKeluar ?? '-' }}
                                            @endif
                                        @else
                                            {{ $absensi->waktuKeluar ?? '-' }}
                                        @endif
                                    </td>

                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $absensi)
                                                <a>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#absensi_edit"
                                                        wire:click="edit('{{ $absensi->id }}')" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('delete', $absensi)
                                                <form action="{{ route('absensi.destroy', $absensi) }}" class="delete-form"
                                                    method="POST">
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


    @include('livewire.t-o.absensi-karyawan.create')
    @include('livewire.t-o.absensi-karyawan.edit')

    <div class="modal fade" id="ImportExcel" wire:ignore tabindex="-1" aria-labelledby="ImportExcelLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="absensikaryawan/import" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ImportExcelLabel">Import Excel</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <a href="{{ asset('assets/format_import/format_import_absensi.xlsx') }}">Download Format
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

</div>

@script
    <script>
        $(document).ready(function() {
            $('#tableAbsensi').DataTable();


            // $wire.on('statusUpdated', () => {
            //     $wire.dispatch('refresh');
            // });

            $('.delete-form').submit(function(event) {
                event.preventDefault(); // Prevent form submission

                Swal.fire({
                    title: 'Hapus Data Absensi',
                    text: "Apakah Kamu Yakin?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus item ini!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        $(this).unbind('submit').submit();
                    }
                });
            });
        });
    </script>
@endscript
