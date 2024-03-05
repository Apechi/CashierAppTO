<div>

    <div class="p-3">
        <div class="row">
            <div class="left col-lg-8 mb-md-3">
                <h5>
                    Menu yang ada
                </h5>
                <hr>
                <div class="dropdown" wire:ignore.self>
                    <button class="btn btn-primary dropdown-toggle" type="button" id="filtersDropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filters
                    </button>
                    <div class="dropdown-menu w-100" wire:ignore.self aria-labelledby="filtersDropdown">
                        <div class="p-4">
                            <div class="kategori">
                                <p style="line-height: 0">Kategori Menu</p>
                                <div class="list Kategori overflow-auto d-flex gap-2">
                                    @foreach ($categories as $category)
                                        <span wire:click="changeTipe(0)">
                                            <button wire:key='category-{{ $category->id }}'
                                                wire:click="changeKategori({{ $category->id }})" type="button"
                                                class="btn btn-{{ $kategori_id == $category->id ? 'primary' : 'light' }}"
                                                onclick="event.stopPropagation()">{{ $category->name }}</button>
                                        </span>
                                    @endforeach

                                </div>
                            </div>

                            <div class="tipe mt-4">
                                <p style="line-height: 0">Tipe Menu</p>
                                <div class="list-tipe  overflow-auto d-flex gap-2">
                                    @if ($types)
                                        @if ($types->isEmpty())
                                            <p>Tipe tidak ada</p>
                                        @else
                                            @foreach ($types as $type)
                                                <button wire:key='type-{{ $type->id }}' type="button"
                                                    wire:click="changeTipe({{ $type->id }})"
                                                    class="btn btn-{{ $type_id == $type->id ? 'primary' : 'light' }}"
                                                    onclick="event.stopPropagation()">{{ $type->name }}</button>
                                            @endforeach
                                        @endif
                                    @else
                                        <p class="text-muted">Pilih Kategori</p>
                                    @endif
                                </div>
                            </div>

                            <div class="input-group mt-3">
                                <span class="input-group-text bi bi-search"></span>
                                <input wire:model.live='search' type="text" class="form-control" placeholder="Search"
                                    aria-label="Search" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-list mt-3">
                    <div class="row">

                        @if ($produk->isEmpty())
                            <div class="d-flex gap-3 justify-content-center text-center">
                                <span class="bi bi-search"></span>
                                <p>Produk Tidak ada</p>
                            </div>
                        @else
                            @foreach ($produk as $item)
                                <div wire:key='menu-{{ $item->id }}' class="col-sm-12  col-md-3">
                                    <div class="card h-100 ">
                                        <img src="{{ $item->image ? \Storage::url($item->image) : '' }}"
                                            class="card-img-top p-3 img-fluid" style="border-radius: 2em"
                                            alt="{{ $item->name }}" />
                                        <div class="card-body">

                                            <span style="font-size: 0.8rem" class="{{ $item->type->icon }}"></span>


                                            <div class=" mb-1">
                                                <div class="d-flex justify-content-start flex-column">
                                                    <p style="font-size: 0.8rem" class="m-0">{{ $item->name }}
                                                    </p>
                                                    <p class="mb-1 text-muted" style="font-size: 0.8rem">Stok:
                                                        {{ $item->stocks->first()->quantity ?? '0' }}</p>
                                                </div>
                                                <h5 class="text-primary mb-0" style="font-size: 0.8rem">
                                                    Rp.{{ $item->price }}</h5>
                                            </div>

                                            {{-- <div class="d-flex justify-content-between mb-2">
                                                <p class="text-muted mb-0">{{ $item->description }}</p>

                                            </div> --}}


                                        </div>
                                        @if (is_null($item->stocks->first()->quantity ?? null) || $item->stocks->first()->quantity <= 0)
                                            <div class="card-footer">
                                                <button type="button" style="font-size: 0.7rem" disabled
                                                    class="btn btn-light w-100">
                                                    Stok Habis
                                                </button>
                                            </div>
                                        @else
                                            <div class="card-footer">

                                                <button style="font-size: 0.7rem"
                                                    wire:click='pilihMenu({{ $item->id }})' type="button"
                                                    class="btn btn-warning w-100">
                                                    Pilih Produk
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="paginate">
                        {{ $produk->links() }}
                    </div>
                </div>
            </div>
            <div class="right col-md-12 col-lg-4">
                <div class="card vh-100">
                    <div class="m-3 d-flex justify-content-start align-items-center gap-2">
                        <i class="fa fa-receipt text-center"></i>
                        <h5 class="m-0">Pesanan Anda</h5>
                        @if (count($produk_detail) != 0)
                            <button data-bs-toggle="modal" data-bs-target="#ClearTransactionModal" type="button"
                                class="ms-auto btn btn-danger">
                                <i class="bi bi-trash">

                                </i>
                            </button>
                        @endif
                    </div>
                    <hr class="m-0">
                    <div class="product-detail h-100 p-3 overflow-auto">
                        @foreach ($produk_detail as $item)
                            <div class="ala">
                                <div wire:key='product_detail-{{ $item['id'] }}' class="card mb-2 p-2">
                                    <div class="produk d-flex align-items-center">
                                        <img class="m-2 img-thumbnail"
                                            src="{{ $item['image'] ? \Storage::url($item['image']) : '' }}"
                                            style="width:50px; height: 100%; object-fit: cover"
                                            alt="{{ $item['name'] }}" />
                                        <div class="detail w-100 d-flex justify-content-between align-items-center">
                                            <div class="info">
                                                <p class="text-primary m-0"
                                                    style="font-weight: bold; font-size: 0.8rem">
                                                    {{ $item['name'] }}
                                                </p>
                                                <p class="text-muted m-0" style="font-size: 0.8rem">
                                                    Rp.{{ $item['sub_total'] }}
                                                </p>
                                            </div>
                                            <div class="qtyControl d-md-flex gap-md-1">

                                                <a type="button" wire:click='decreaseQuantity({{ $item['id'] }})'
                                                    class="bi bi-dash-circle-fill">
                                                </a>
                                                <p style="font-size: 0.8rem" class="text-muted m-0">
                                                    {{ $item['qty'] }}</p>
                                                <a type="button" wire:click='increaseQuantity({{ $item['id'] }})'
                                                    class="bi bi-plus-circle-fill ">

                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    @if ($item['id'] === $stokBeak)
                                        @error('stok-habis')
                                            <p class="text-danger m-0">Melebihi Stok!</p>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if (count($produk_detail) != 0)
                        <div class="checkout m-3">
                            <div class="total d-flex justify-content-between">
                                <p>Total: </p>
                                <p class="text-primary"> Rp. {{ $total_price }}</p>
                            </div>
                            <button data-bs-toggle="modal" wire:click='setupCheckout()'
                                data-bs-target="#CheckoutModal" type="button" class="btn btn-success w-100">
                                Checkout
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ClearTransactionModal" tabindex="-1" aria-labelledby="ClearTransactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ClearTransactionModalLabel">Yakin ingin menghapus semua
                        pesanan
                        anda?
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" data-bs-dismiss="modal" wire:click='clearOrder()'
                        class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.transaction.checkout')



</div>

@script
    <script>
        $wire.on('transactionDialogTrue', () => {
            let no_faktur = $wire.no_faktur
            window.open("transaksi/invoice/" + no_faktur, "_blank",
                "width=500px,height=700px");
            location.reload();
        });
    </script>
@endscript
