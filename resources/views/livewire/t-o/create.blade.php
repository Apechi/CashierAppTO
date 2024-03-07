<div class="modal fade" id="tambah_titipan" wire:ignore tabindex="-1" aria-labelledby="tambah_titipanLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form wire:submit='store'>

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambah_titipanLabel">@lang('crud.titipan.create_title')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                            id="nama_produk" wire:model.lazy='nama_produk' name="nama_produk"
                            value="{{ old('nama_produk') }}">
                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror"
                            id="nama_supplier" wire:model.lazy='nama_supplier' name="nama_supplier"
                            value="{{ old('nama_supplier') }}">
                        @error('nama_supplier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" wire:model.lazy='stok'
                            class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
                            value="{{ old('stok') }}">
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="number" wire:model.lazy='harga_beli'
                            class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli"
                            name="harga_beli" value="{{ old('harga_beli') }}">
                        @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" readonly class="form-control @error('harga_jual') is-invalid @enderror"
                            id="harga_jual" wire:model.lazy='harga_jual' name="harga_jual"
                            value="{{ old('harga_jual') }}">
                        @error('harga_jual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- <label for="keuntungan" class="form-label" style="font-size: 0.7rem">Keuntungan</label>
                        <input type="number" style="pointer-events: none" readonly
                            class="form-control @error('keuntungan') is-invalid @enderror" id="keuntungan"
                            name="keuntungan" wire:model.lazy='keuntungan' value="{{ old('keuntungan') }}">
                        @error('keuntungan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}


                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" wire:model.lazy='keterangan' id="keterangan"
                            name="keterangan" value="{{ old('keterangan') }}"></textarea>
                        @error('keterangan')
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
