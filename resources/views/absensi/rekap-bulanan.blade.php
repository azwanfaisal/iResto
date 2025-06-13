<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">📊 Rekap Absensi Bulanan</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Filter Form -->
        <div class="bg-white shadow rounded-lg p-6 mb-6 space-y-4">
            <form method="GET" action="{{ route('absensi.rekapBulanan') }}"
                class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <!-- Bulan -->
                <div>
                    <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan</label>
                    <input type="month" name="bulan" id="bulan" value="{{ $bulan }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Karyawan -->
                <div>
                    <label for="karyawan_id" class="block text-sm font-medium text-gray-700">Pilih Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua</option>
                        @foreach ($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}" {{ $karyawan_id == $karyawan->id ? 'selected' : '' }}>
                                {{ $karyawan->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Filter -->
                <div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 transition duration-200 w-full justify-center">
                        🔍 Filter
                    </button>
                </div>
            </form>

            <!-- Tombol PDF -->
            <div>
                <a href="{{ route('absensi.rekapBulananPdf', ['bulan' => $bulan, 'karyawan_id' => $karyawan_id]) }}"
                    class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow text-sm">
                    🖨️ Cetak PDF
                </a>
                <a href="{{ route('absensi.rekapBulananExcel', ['bulan' => $bulan, 'karyawan_id' => $karyawan_id]) }}"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow text-sm ml-2">
                    📥 Export Excel
                </a>
            </div>
        </div>

        <!-- Tabel Rekap -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-md text-white bg-blue-600">
                    <tr>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-center">Hadir</th>
                        <th class="p-3 text-center">Izin</th>
                        <th class="p-3 text-center">Sakit</th>
                        <th class="p-3 text-center">Cuti</th>
                        <th class="p-3 text-center">Alpa</th>
                        <th class="p-3 text-center">Total Hari</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @forelse ($rekap as $item)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="p-3">{{ $item->karyawan->nama_lengkap }}</td>
                            <td class="p-3 text-center text-green-600 font-semibold">{{ $item->hadir }}</td>
                            <td class="p-3 text-center text-yellow-500">{{ $item->izin }}</td>
                            <td class="p-3 text-center text-orange-500">{{ $item->sakit }}</td>
                            <td class="p-3 text-center text-indigo-500">{{ $item->cuti }}</td>
                            <td class="p-3 text-center text-red-600 font-semibold">{{ $item->alpa }}</td>
                            <td class="p-3 text-center font-semibold">{{ $item->total_hari }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center p-6 text-gray-500">Tidak ada data untuk bulan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
