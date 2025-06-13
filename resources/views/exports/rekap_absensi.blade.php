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
        @foreach($rekap as $item)
            <tr>
                <td>{{ $item->karyawan->nama_lengkap }}</td>
                <td>{{ $item->hadir }}</td>
                <td>{{ $item->izin }}</td>
                <td>{{ $item->sakit }}</td>
                <td>{{ $item->cuti }}</td>
                <td>{{ $item->alpa }}</td>
                <td>{{ $item->total_hari }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
