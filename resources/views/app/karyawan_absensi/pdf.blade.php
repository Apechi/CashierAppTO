<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: orange;

        }

        h4 {
            text-align: center;
            margin-bottom: 1em;
        }
    </style>
</head>

<body>
    <h4>Data Absensi Karyawan</h4>

    <table class="table table-striped">
        <thead>
            <th>Nama Karyawan</th>
            <th>Tanggal Masuk</th>
            <th>Waktu Masuk</th>
            <th>Status</th>
            <th>Waktu Keluar</th>
        </thead>
        <tbody>
            @foreach ($data as $show)
                <tr>
                    <td>{{ $show->namaKaryawan ?? '' }}</td>
                    <td>{{ $show->tanggalMasuk ? \Carbon\Carbon::parse($show->tanggalMasuk)->format('j F Y') : '' }}
                    </td>
                    <td>{{ $show->waktuMasuk ?? '' }}</td>
                    <td>{{ $show->status ?? '' }}</td>
                    <td>
                        @if ($show->waktuKeluar == '00:00:00' && $show->status == 'masuk')
                            Belum Keluar
                        @elseif ($show->waktuKeluar == '00:00:00' && $show->status != 'masuk')
                            Tidak Hadir
                        @else
                            {{ $show->waktuKeluar }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
