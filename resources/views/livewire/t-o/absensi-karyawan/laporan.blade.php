<div>
    <h3>Laporan Absensi Karyawan</h3>
    <div class="container mt-5">
        <div>
            <form wire:submit='getLaporan'>
                <div class="input-tanggal row">
                    <div class="col-md-5">
                        <label class="p-2" for="awal">Tanggal Mulai</label>
                        <div class="input-group w-100 align-items-center @error('start_date') is-invalid @enderror">
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                name="start_date" wire:model.lazy='start_date' id="">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label class="p-2" for="akhir">Tanggal Akhir</label>
                        <div class="input-group align-items-center @error('end_date') is-invalid @enderror">
                            <input class="form-control @error('end_date') is-invalid @enderror" type="date"
                                name="end_date" wire:model.lazy='end_date' id="">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary col-md-2 my-auto" type="submit">Search</button>
                </div>
            </form>


            <div class="table-responsive mt-4">
                @if (!empty($data_laporan_absensi))
                    <a href="/absensilaporan/exportpdf/{{ $start_date }}/{{ $end_date }}"
                        class="btn btn-dark text-end">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                @endif
                <table id="tableTransaksi" class="table table-bordered table-hover">
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_laporan_absensi as $absensi)
                            <tr>
                                <td>{{ $absensi->namaKaryawan ?? '-' }}</td>
                                <td>{{ $absensi->tanggalMasuk ?? '-' }}</td>
                                <td>{{ $absensi->waktuMasuk ?? '-' }}</td>
                                <td>{{ $absensi->status ?? '-' }}</td>
                                <td>{{ $absensi->waktuKeluar ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data / Pilih tanggal</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-center">Total Keterangan</td>
                            <td>Masuk: {{ $masuk }}</td>
                            <td>Cuti: {{ $cuti }}</td>
                            <td>Sakit: {{ $sakit }}</td>

                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
