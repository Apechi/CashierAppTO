<div class="modal fade" id="absensi_tambah" wire:ignore.self tabindex="-1" aria-labelledby="absensi_tambahLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form wire:submit='store'>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="absensi_tambahLabel">@lang('crud.absensi.create_title')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control @error('nama_karyawan') is-invalid @enderror"
                            id="nama_karyawan" wire:model.lazy='nama_karyawan' name="nama_karyawan"
                            value="{{ old('nama_karyawan') }}">
                        @error('nama_karyawan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                            id="tanggal_masuk" wire:model.lazy='tanggal_masuk' name="tanggal_masuk"
                            value="{{ old('tanggal_masuk') }}">
                        @error('tanggal_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                        <input type="time" step="any"
                            class="form-control @error('waktu_masuk') is-invalid @enderror" id="waktu_masuk"
                            wire:model.lazy='waktu_masuk' name="waktu_masuk" value="{{ old('waktu_masuk') }}">
                        @error('waktu_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                            wire:model.lazy='status' name="status">
                            <option value="">Pilih Status</option>
                            <option value="sakit">Sakit</option>
                            <option value="cuti">Cuti</option>
                            <option value="masuk">Masuk</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>
