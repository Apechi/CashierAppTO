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
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Tipe Menu</th>
        </thead>
        <tbody>
            @foreach ($data as $show)
                <tr>
                    <td>{{ $show->name }}</td>
                    <td>{{ $show->price }}</td>
                    <td>{{ $show->description }}</td>
                    <td>{{ $show->type->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
