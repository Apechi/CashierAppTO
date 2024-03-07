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
            <th>Name</th>
            <th>Email</th>
            <th>No Telp</th>
            <th>Alamat</th>
        </thead>
        <tbody>
            @foreach ($data as $show)
                <tr>
                    <td>{{ $show->name }}</td>
                    <td>{{ $show->email }}</td>
                    <td>{{ $show->no_telp }}</td>
                    <td>{{ $show->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
