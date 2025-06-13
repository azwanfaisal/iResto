<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Absensi Bulanan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Rekap Absensi Bulanan</h2>
    <p>Bulan: {{ \Carbon\Carbon::parse($bulan . '-01')->translatedFormat('F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Cuti</th>
                <th>Alpa</th>
                <th>Total Hari</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $item)
                <tr>
                    <td>{{ $item['karyawan']->nama_lengkap }}</td>
                    <td>{{ $item['hadir'] }}</td>
                    <td>{{ $item['izin'] }}</td>
                    <td>{{ $item['sakit'] }}</td>
                    <td>{{ $item['cuti'] }}</td>
                    <td>{{ $item['alpa'] }}</td>
                    <td>{{ $item['total_hari'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
