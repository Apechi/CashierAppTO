<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
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
        <h1>Laporan Transaksi Apechi Cafe</h1>
        <h2>Dari tanggal {{ $start_date }} sampai {{ $end_date }}</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Metode Pembayaran</th>
                <th>Keterangan</th>
                <th class="text-right">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $transaction)
                <tr>
                    <td>{{ $transaction->id ?? '-' }}</td>
                    <td>{{ date('Y-m-d', strtotime($transaction->date)) ?? '-' }}</td>
                    <td>{{ $transaction->customer->name ?? '-' }}</td>
                    <td>{{ $transaction->payment_method ?? '-' }}</td> wire:
                    <td>{{ $transaction->keterangan ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5">Total Pendapatan</th>
                <td class="text-right">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
