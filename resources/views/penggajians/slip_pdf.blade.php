<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 80px;
            margin-bottom: 10px;
        }
        h2 {
            margin: 0;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        td, th {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }
        .total {
            font-weight: bold;
            background-color: #e3f6e3;
        }
        .potongan {
            color: red;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature img {
            max-height: 60px;
        }
        .signature p {
            margin: 4px 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('logo.png') }}" alt="Logo">
        <h2>Slip Gaji Karyawan</h2>
        <p>{{ $penggajian->karyawan->nama_lengkap }}</p>
        <p>Tanggal Gajian: {{ \Carbon\Carbon::parse($penggajian->tanggal_gajian)->format('d M Y') }}</p>
    </div>

    <table>
        <tbody>
            <tr>
                <td>Gaji Pokok</td>
                <td>Rp {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunjangan Transport</td>
                <td>Rp {{ number_format($penggajian->tunjangan_transport, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunjangan Makan</td>
                <td>Rp {{ number_format($penggajian->tunjangan_makan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunjangan Lembur</td>
                <td>Rp {{ number_format($penggajian->tunjangan_lembur, 0, ',', '.') }}</td>
            </tr>
            <tr class="potongan">
                <td>Potongan</td>
                <td>Rp {{ number_format($penggajian->potongan, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td>Total Gaji Diterima</td>
                <td>Rp {{ number_format($penggajian->total_gaji, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p>Hormat Kami,</p>
        <img src="{{ public_path('ttd.png') }}" alt="Tanda Tangan">
        <p><strong>Manajer HRD</strong></p>
    </div>

    <div class="footer">
        <p>Dicetak: {{ now()->format('d M Y H:i') }}</p>
    </div>

</body>
</html>
