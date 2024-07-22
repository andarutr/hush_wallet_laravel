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
    <h5>Periode: {{ $dari }} - {{ $ke }}</h5>
    <p>Bank: {{ $bank->nama_bank }}</p>
    <table>
        <thead> 
            <tr>
                <th>ID Transaksi</th>
                <th>Jenis Pengeluaran</th>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Catatan</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($outcome as $out)
            <tr>
                <td>{{ $out->id_transaksi }}</td>
                <td>{{ $out->jenis_pengeluaran }}</td>
                <td>{{ $out->tgl }}</td>
                <td>Rp {{ number_format($out->nominal, 0, ',', '.') }}</td>
                <td>{{ $out->catatan }}</td>
                <td>{{ $out->created_at }}</td>
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