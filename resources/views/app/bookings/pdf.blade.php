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
    </style>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <th>Tanggal</th>
            <th>Meja</th>
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th>Nama Pemesan</th>
            <th>Total Pelanggan</th>
        </thead>
        <tbody>
            @foreach ($data as $show)
                <tr>
                    <td>{{ $show->date }}</td>
                    <td>{{ $show->table->table_number }}</td>
                    <td>{{ $show->start_time }}</td>
                    <td>{{ $show->end_time }}</td>
                    <td>{{ $show->bookers_name }}</td>
                    <td>{{ $show->total_customer }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
