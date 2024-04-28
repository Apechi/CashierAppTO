@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-utensils"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Jumlah Menu</span>
                                    <span class="info-box-number">{{ $jumlahMenu }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Jumlah Pelanggan</span>
                                    <span class="info-box-number">{{ $jumlahPelanggan }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-money-bill-wave"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Jumlah Transaksi</span>
                                    <span class="info-box-number">{{ $jumlahTransaksi }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-calendar-day"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Transaksi Hari Ini</span>
                                    <span class="info-box-number">{{ $jumlahTransaksiPertanggal }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-secondary"><i class="fas fa-dollar-sign"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Pendapatan</span>
                                    <span class="info-box-number">Rp {{ number_format($totalPendapatan, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-clipboard-list"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Menu Paling Laku: </span>
                                    <span class="info-box-number">{{ $menuPalingLaku->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-clipboard-list"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Stok Hampir Habis:</span>
                                    <span class="info-box-number">
                                        @foreach ($menusWithLowStock as $item)
                                            <p>{{ $item->name }}: {{ $item->stocks->first()->quantity }}</p>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Transaksi Terakhir</div>

                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Total Harga</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaksiTerakhir as $transaksi)
                                                <tr>
                                                    <td>{{ $transaksi->id }}</td>
                                                    <td>Rp {{ number_format($transaksi->total_price, 2) }}</td>
                                                    <td>{{ $transaksi->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
