@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h3>Dashboard</h3>

            <div class="col-md-12">
                {{-- <select id="bulan" class="form-control w-25 m-2 ms-3">
                    <option selected>Pilih Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select> --}}
                <div class="tanggal m-2 ms-4">

                    <label for="tanggal_mulai">Tanggal Mulai:</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai">

                    <label for="tanggal_selesai">Tanggal Selesai:</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai">
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-dollar-sign fs-3 bg-success text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text label_total_pendapatan">Total Pendapatan (Keseluruhan):</p>
                                </div>
                                <span class="info-box-number fs-4 fw-bold text-success total_pendapatan">Rp
                                    {{ number_format($totalPendapatan, 2, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-money-bill-wave fs-3 bg-success text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text label_jumlah_transaksi">Jumlah Transaksi (Keseluruhan):</p>
                                </div>
                                <span
                                    class="info-box-number jumlah_transaksi fs-4 fw-bold text-dark-emphasis">{{ $jumlahTransaksi }}</span>
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

                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <div class="info-box card mb-0 p-3">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-chart-bar fs-3 bg-success text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text label_judul_chart">Grafik Pendapatan (Bulan Ini):
                                    </p>
                                </div>
                                <div class="info-box-content">
                                    <canvas id="dailyIncomeChart" width="400" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-box card mb-0 p-3" style="margin-top: -8em">
                                <div class="info-box-content d-flex gap-3">
                                    <span class="info-box-icon"><i
                                            class="fas fa-clipboard-list fs-3 bg-info text-white p-2 rounded-1"></i></span>
                                    <p class="info-box-text ">Top 5 Penjualan:</p>
                                </div>
                                <div class="listMenu overflow-y-scroll" style="height: 27em">
                                    @foreach ($menuData as $item)
                                        <div class="menu d-flex pt-2 ">
                                            <img src="{{ $item['image'] ? \Storage::url($item['image']) : '' }}"
                                                style="width:50px; height: 100%; object-fit: cover" alt=""
                                                class="img-fluid w-2 h-2 rounded img-thumbnail">
                                            <div class="info ps-2">
                                                <p class="fs-5 fw-bold text-dark-emphasis mb-0">{{ $item['name'] }}</p>
                                                <p class="info-box-number ">{{ $item['total'] }}x
                                                    Terjual</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6 ">
                        <div class="info-box card mb-2 p-3 overflow-auto" style="height: 500px;">
                            <div class="info-box-content d-flex gap-3">
                                <span class="info-box-icon"><i
                                        class="fas fa-calendar-day fs-3 bg-warning text-white p-2 rounded-1"></i></span>
                                <p class="info-box-text">Transaksi Terbaru</p>
                                <br>
                            </div>
                            <div>
                                @foreach ($transaksiTerbaru as $transaction)
                                    <div class="p-1 mt-2">
                                        <div class="menu d-flex pt-2 row">
                                            <div class="info col-md-8">
                                                <a href="/transaction/show/{{ $transaction['id'] }}"
                                                    class="text-primary mb-0">#{{ $transaction['id'] }}</a>
                                                @foreach ($transaction['list_menu'] as $item)
                                                    <p class="mb-0">{{ $item }}</p>
                                                @endforeach
                                            </div>
                                            <p class="info-box-number col-md-4">Total: Rp
                                                {{ number_format($transaction['total']) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mb-3">
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


            $('#tanggal_mulai, #tanggal_selesai').change(function() {
                var tanggalMulai = $('#tanggal_mulai').val();
                var tanggalSelesai = $('#tanggal_selesai').val();
                $.ajax({
                    url: '/get-chart-data',
                    type: 'GET',
                    data: {
                        tanggal_mulai: tanggalMulai,
                        tanggal_selesai: tanggalSelesai
                    },
                    success: function(data) {
                        console.log(data);
                        dailyIncomeChart.data.labels = Object.keys(data);
                        dailyIncomeChart.data.datasets[0].data = Object.values(data);
                        dailyIncomeChart.update();
                        $('.label_judul_chart').text(
                            `Grafik Pendapatan Tanggal: ${tanggalMulai} - ${tanggalSelesai}`
                        )
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });


                $.ajax({
                    type: "GET",
                    url: "/total-pendapatan",
                    data: {
                        tanggal_mulai: tanggalMulai,
                        tanggal_selesai: tanggalSelesai
                    },
                    success: function(response) {
                        var totalPendapatan = response.total_pendapatan.toLocaleString(
                            'id-ID', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });

                        $(".total_pendapatan").text("Rp " + totalPendapatan);
                        $(".label_total_pendapatan").text("Total Pendapatan (Terfilter):");


                    }
                });

                $.ajax({
                    type: "GET",
                    url: "/total-transaksi",
                    data: {
                        tanggal_mulai: tanggalMulai,
                        tanggal_selesai: tanggalSelesai
                    },
                    success: function(response) {
                        $('.jumlah_transaksi').text(response.total_transaksi);
                        $('.label_jumlah_transaksi').text("Jumlah Transaksi (Terfilter)");
                    }
                });
            });




            var ctx = document.getElementById('dailyIncomeChart').getContext('2d');
            var dailyIncomeChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_keys($totalPendapatanPerHari)) !!},
                    datasets: [{
                        label: 'Pendapatan Per Hari',
                        data: {!! json_encode(array_values($totalPendapatanPerHari)) !!},
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
