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
    <h1>Rekapan Income</h1>
    <h5>Periode: {{ $dari }} - {{ $ke }}</h5>
    <p>Bank: {{ $bank->nama_bank }}</p>
    <table>
        <thead> 
            <tr>
                <th>ID Transaksi</th>
                <th>Jenis Pendapatan</th>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Catatan</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($income as $inc)
            <tr>
                <td>{{ $inc->id_transaksi }}</td>
                <td>{{ $inc->jenis_pendapatan }}</td>
                <td>{{ $inc->tgl_income }}</td>
                <td>Rp {{ number_format($inc->nominal, 0, ',', '.') }}</td>
                <td>{{ $inc->catatan }}</td>
                <td>{{ $inc->created_at }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"><b>Total</b></td>
                <td colspan="3"><b>Rp {{ number_format($total, 0, ',', '.') }}</b></td>
            </tr>
        </tbody>
    </table>
</body>
</html>