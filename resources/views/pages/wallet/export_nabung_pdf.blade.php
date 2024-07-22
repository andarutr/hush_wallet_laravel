<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        thead {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Rekapan Outcome</h1>
    <p>Platform: {{ $platform }}</p>
    <table>
        <thead> 
            <tr>
                <th>ID Transaksi</th>
                <th>Jenis</th>
                <th>Platform</th>
                <th>Nominal</th>
                <th>Catatan</th>
                <th>Tgl</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nabung as $nb)
            <tr>
                <td>{{ $nb->id_transaksi }}</td>
                <td>{{ $nb->jenis_tabungan }}</td>
                <td>{{ $nb->platform }}</td>
                <td>Rp {{ number_format($nb->nominal, 0, ',', '.') }}</td>
                <td>{{ $nb->catatan }}</td>
                <td>{{ $nb->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>