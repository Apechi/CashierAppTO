<div>
    <h3>Laporan Transaksi</h3>
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
                <table id="tableTransaksi" class="table table-bordered table-hover">
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_laporan as $transaction)
                            <tr>
                                <td>{{ $transaction->id ?? '-' }}</td>
                                <td>{{ $transaction->date ?? '-' }}</td>
                                <td>{{ $transaction->customer->name ?? '-' }}</td>
                                <td>{{ $transaction->payment_method ?? '-' }}</td>
                                <td>{{ $transaction->keterangan ?? '-' }}</td>
                                <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data / Pilih tanggal</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right">Total Pendapatan</th>
                            <th>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <button class="btn btn-secondary">Kembali</button>
        </div>
    </div>
</div>
