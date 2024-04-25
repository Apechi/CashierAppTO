<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .title h2 {
            font-size: 18px;
            font-weight: normal;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tfoot th {
            text-align: right;
            font-weight: normal;
        }

        tfoot td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="title">
        <h1>Laporan Absensi Karyawan Apechi Cafe</h1>
        <h2>Dari tanggal {{ $start_date }} sampai {{ $end_date }}</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Tanggal Masuk</th>
                <th>Waktu Masuk</th>
                <th>status</th>
                <th>Waktu Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $absensi)
                <tr>
                    <td>{{ $absensi->namaKaryawan ?? '' }}</td>
                    <td>{{ $absensi->tanggalMasuk ? \Carbon\Carbon::parse($absensi->tanggalMasuk)->format('j F Y') : '' }}
                    </td>
                    <td>{{ $absensi->waktuMasuk ?? '' }}</td>
                    <td>{{ $absensi->status ?? '' }}</td>
                    <td>
                        @if ($absensi->waktuKeluar == '00:00:00' && $absensi->status == 'masuk')
                            Belum Keluar
                        @elseif ($absensi->waktuKeluar == '00:00:00' && $absensi->status != 'masuk')
                            Tidak Hadir
                        @else
                            {{ $absensi->waktuKeluar }}
                        @endif
                    </td>
                </tr>
            @endforeach
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
</body>

</html>
