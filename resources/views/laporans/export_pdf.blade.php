<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 80px;
            margin-bottom: 10px;
        }

        h2 {
            margin: 0;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('logo.png') }}" alt="Logo">
        <h2>Laporan Data Kinerja</h2>
        <small>{{ now()->format('d M Y') }}</small>
    </div>

    <table>
        <thead>
            <tr>
                <th>Periode Awal</th>
                <th>Periode Akhir</th>
                <th>Total Karyawan</th>
                <th>Total Absensi</th>
                <th>Total Penggajian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $laporan)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($laporan->periode_awal)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->periode_akhir)->format('d-m-Y') }}</td>
                    <td>{{ $laporan->total_karyawan }}</td>
                    <td>{{ $laporan->total_absensi }}</td>
                    <td>Rp {{ number_format($laporan->total_penggajian, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh sistem pada {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
