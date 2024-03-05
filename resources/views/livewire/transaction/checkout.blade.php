<div class="modal fade vh-100" wire:ignore.self id="CheckoutModal" tabindex="-1" aria-labelledby="CheckoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form wire:submit="checkout">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="CheckoutModalLabel">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="input-luhur d-md-flex justify-content-between p-3">
                        <p>
                            No Faktur: {{ $no_faktur }}
                        </p>
                        <div class="">
                            <select wire:model.lazy="customer_id" name="customer_id"
                                class="form-select form-select-sm @error('customer_id') is-invalid @enderror">
                                <option selected>Pilih Customer</option>
                                @foreach ($customer as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="border-1 border border-primary rounded overflow-hidden">
                        <div class="list overflow-auto" style="height: 15em">
                            @foreach ($produk_detail as $item)
                                <div wire:key='product_details-{{ $item['id'] }}' class="mb-1    p-2">
                                    <div class="produk d-flex align-items-center">
                                        <img class="m-2 img-thumbnail"
                                            src="{{ $item['image'] ? \Storage::url($item['image']) : '' }}"
                                            style="width:50px; height: 100%; object-fit: cover"
                                            alt="{{ $item['name'] }}" />
                                        <div class="detail w-100 d-flex justify-content-between align-items-center">
                                            <div class="info d-flex justify-content-between align-items-center w-100">
                                                <p class=" m-0">
                                                    {{ $item['name'] }} x{{ $item['qty'] }}
                                                </p>
                                                <p class="m-0" style="font-weight: bold">
                                                    Rp.{{ $item['sub_total'] }}</p>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="detail p-2 d-flex flex-row gap-3">
                        <div class="">
                            <input type="date" name="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror" wire:model.live='tanggal'
                                value="{{ now()->format('m-d-Y') }}" max="{{ date('Y-m-d') }}"
                                min="{{ date('Y-m-d') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="div">
                            <select wire:model.lazy="tipe_pembayaran" name="tipe_pembayaran"
                                class="form-select form-select-sm @error('tipe_pembayaran') is-invalid @enderror">
                                <option selected>Pilih Tipe Pembayaran</option>
                                <option value="cash">Tunai</option>
                                <option value="debit">Debit</option>
                            </select>
                            @error('tipe_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    @if ($tipe_pembayaran == 'cash')
                        <div class="mb-3">
                            <label for="total_bayar" class="form-label">Bayar</label>
                            <input type="number" name="total_bayar" wire:change="kembalianGen()"
                                wire:model.lazy='total_bayar'
                                class="form-control @error('total_bayar') is-invalid @enderror">
                            @error('total_bayar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan_pembayaran') is-invalid @enderror" name="keterangan"
                            wire:model.lazy='keterangan_pembayaran' id="keterangan" cols="30" rows="5"></textarea>
                        @error('keterangan_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="totalAndKembalian p-3">
                    <div class="total d-flex  justify-content-between align-items-center">
                        <h5>Total:</h5>
                        <input type="text" hidden name="total_price" value="{{ $total_price }}">
                        <h5>Rp. {{ $total_price }}</h5>
                    </div>
                    @if ($tipe_pembayaran == 'cash')
                        <div class="total d-flex  justify-content-between align-items-center">
                            <h5>Kembalian:</h5>
                            @if (!is_string($kembalian))
                                <h5>Rp. {{ $kembalian }}</h5>
                            @else
                                <h5 class="text-danger"> {{ $kembalian }}</h5>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="submit" class="w-100 btn btn-success">Bayar</button>
                </div>
            </div>
        </form>

    </div>
</div>
