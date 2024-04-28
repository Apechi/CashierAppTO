@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h3>Dashboard</h3>
            <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-dollar-sign fs-3 bg-success text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text">Total Pendapatan:</p>
                                </div>
                                <span class="info-box-number fs-4 fw-bold text-success">Rp
                                    {{ number_format($totalPendapatan, 2) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-money-bill-wave fs-3 bg-success text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text">Jumlah Transaksi:</p>
                                </div>
                                <span class="info-box-number fs-4 fw-bold text-dark-emphasis">{{ $jumlahTransaksi }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-calendar-day fs-3 bg-primary text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text">Transaksi Hari Ini:</p>
                                </div>
                                <span
                                    class="info-box-number fs-4 fw-bold text-dark-emphasis">{{ $jumlahTransaksiPertanggal }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4  mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-utensils fs-3 bg-info text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text">Jumlah Menu:</p>
                                </div>
                                <span class="info-box-number fs-4 fw-bold text-dark-emphasis">{{ $jumlahMenu }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-users fs-3 bg-info text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text">Jumlah Pelanggan:</p>
                                </div>
                                <span class="info-box-number fs-4 fw-bold text-dark-emphasis">{{ $jumlahPelanggan }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-clipboard-list fs-3 bg-warning text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text">Menu Paling Laku:</p>
                                </div>
                                <span
                                    class="info-box-number fs-4 fw-bold text-dark-emphasis">{{ $menuPalingLaku->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-clipboard-list fs-3 bg-warning text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text">Stok Hampir Habis:</p>
                                </div>
                                <div class="info-box-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-stok">
                                            <thead>
                                                <tr>
                                                    <th>Nama Menu</th>
                                                    <th>Stok</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($menusWithLowStock as $item)
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->stocks->first()->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-chart-bar fs-3 bg-primary text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text">Total Pendapatan per Minggu (Bulan Ini)</p>
                                </div>
                                <div class="info-box-content">
                                    <canvas id="weeklyIncomeChart" width="400" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-3">
                                <p class="mb-0 fw-bold text-primary">Transaksi Terakhir</p>
                                <table class="table" id="transaksi-terakhir">
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
                                                <td>{{ date('d F Y', strtotime($transaksi->date)) }}</td>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-stok').DataTable({
                searching: false,
                pageLength: 5,
                bLengthChange: false

            });


            $('#transaksi-terakhir').DataTable({
                bLengthChange: false
            });

            console.log({!! json_encode(array_values($totalPendapatanPerMinggu)) !!});

            var ctx = document.getElementById('weeklyIncomeChart').getContext('2d');
            var weeklyIncomeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_keys($totalPendapatanPerMinggu)) !!},
                    datasets: [{
                        label: 'Pendapatan Per Minggu',
                        data: {!! json_encode(array_values($totalPendapatanPerMinggu)) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(0, 123, 255)',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endpush
