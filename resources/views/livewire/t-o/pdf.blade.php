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
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Nama Supplier</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Keterangan</th>
        </thead>
        <tbody>
            @foreach ($data as $show)
                <tr>
                    <td>{{ $show->id }}</td>
                    <td>{{ $show->nama_produk }}</td>
                    <td>{{ $show->nama_supplier }}</td>
                    <td>{{ $show->harga_jual }}</td>
                    <td>{{ $show->harga_beli }}</td>
                    <td>{{ $show->stok }}</td>
                    <td>{{ $show->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
