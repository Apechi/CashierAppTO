<div>
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="d-flex justify-content-end">

                <div class="text-right">
                    <a href="/transaksilist/exportpdf" class="btn btn-dark">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                    <a href="/listTransaction/export/" class="btn btn-dark">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                    </a>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.transaction.index_title')</h4>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal:</label>
                                <input type="date" id="date" name="tanggal" wire:model.lazy='tanggal'
                                    wire:change='cek' class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
                                <select id="paymentMethod" name="metode_pembayaran" wire:change='cek'
                                    wire:model.lazy='metode_pembayaran' class="form-select">
                                    <option wire:ignore selected>Pilih Filter</option>
                                    <option value="cash">Cash</option>
                                    <option value="debit">Debit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="menu" class="form-label">Menu:</label>
                                <input type="text" id="menuSearchInput" class="form-control"
                                    placeholder="Search menu...">
                                <select id="menu" name="menu" wire:model.lazy='menu' wire:change='cek'
                                    class="form-select">
                                    <option selected>Pilih Menu</option>
                                    @foreach ($list_menu as $id => $menu)
                                        <option value="{{ $id }}">{{ $menu }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control search-input" placeholder="Cari...">
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tableTransaksi" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.customer')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.payment_method')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.keterangan')
                                </th>
                                <th class="text-right">
                                    @lang('crud.transaction.inputs.total_price')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr wire:key='list-transaksi-{{ $transaction->id }}'>
                                    <td>{{ $transaction->id ?? '-' }}</td>
                                    <td>{{ $transaction->date ?? '-' }}</td>
                                    <td>{{ $transaction->customer->name ?? '-' }}</td>
                                    <td>{{ $transaction->payment_method ?? '-' }}</td>
                                    <td>{{ $transaction->keterangan ?? '-' }}</td>
                                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group d-flex gap-2">
                                            @can('view', $transaction)
                                                <a href="/transaction/show/{{ $transaction->id }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                <a class="buka-invoice" data-no_invoice="{{ $transaction->id ?? '' }}">
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="bi bi-receipt"></i>
                                                    </button>
                                                </a>
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
</div>
@script
    <script>
        let table

        $(document).ready(function() {
            $('#menuSearchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#menu option').each(function() {
                    var optionText = $(this).text().toLowerCase();
                    $(this).toggle(optionText.includes(searchText));
                });

                // Open the select dropdown when there's input in the search field
                $('#menu').click();
            });

            $('#searchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();

                $('#tableTransaksi tbody tr').each(function() {
                    var rowText = $(this).text().toLowerCase(); // Get text of entire row

                    // Show row if any column contains the search text
                    if (rowText.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

        });

        // $wire.on('reinitialize-datatable', () => {



        //     $('#tableTransaksi').DataTable({});

        //     console.log('tes');
        // });

        $('.buka-invoice').click(function(e) {


            let no_faktur = $(this).data('no_invoice');

            window.open("/transaksi/invoice/" + no_faktur, "_blank",
                "width=500px,height=700px");

        });
    </script>
@endscript
