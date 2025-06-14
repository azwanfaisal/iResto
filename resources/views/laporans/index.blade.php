<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Form Input Laporan -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('laporans.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="periode_awal"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Periode Awal</label>
                            <input type="date" name="periode_awal" id="periode_awal"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                required>
                        </div>
                        <div>
                            <label for="periode_akhir"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Periode Akhir</label>
                            <input type="date" name="periode_akhir" id="periode_akhir"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                            Simpan Laporan
                        </button>
                    </div>
                </form>
            </div>
            <!-- Form Filter Periode -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('laporans.index') }}"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div>
                        <label for="from" class="block text-sm text-gray-700 dark:text-gray-300">Dari
                            Tanggal</label>
                        <input type="date" name="from" id="from" value="{{ request('from') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    </div>
                    <div>
                        <label for="to" class="block text-sm text-gray-700 dark:text-gray-300">Sampai
                            Tanggal</label>
                        <input type="date" name="to" id="to" value="{{ request('to') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    </div>
                    <div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
            <div class="mb-4 flex gap-4">
                <a href="{{ route('laporans.export.excel') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Export Excel</a>
                <a href="{{ route('laporans.export.pdf') }}"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Export PDF</a>
            </div>


            <!-- Tabel Laporan -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Daftar Laporan</h3>

                <div class="relative overflow-x-auto shadow-md rounded-lg">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Periode</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Total Karyawan</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Total Absensi</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Total Penggajian</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($laporans as $laporan)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $laporan->periode_awal }} s.d.
                                        {{ $laporan->periode_akhir }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $laporan->total_karyawan }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $laporan->total_absensi }}</td>
                                    <td class="px-6 py-4 text-sm">Rp
                                        {{ number_format($laporan->total_penggajian, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 flex space-x-2">

                                        <!-- Tombol Detail -->
                                        <a href="{{ route('laporans.show', $laporan->id) }}"
                                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 text-xs flex items-center"
                                            title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M10 3.5c-4.837 0-9 3.582-9 6.5s4.163 6.5 9 6.5 9-3.582 9-6.5-4.163-6.5-9-6.5zM10 14.5c-2.485 0-4.5-2.015-4.5-4.5S7.515 5.5 10 5.5s4.5 2.015 4.5 4.5-2.015 4.5-4.5 4.5zM10 7a3 3 0 100 6 3 3 0 000-6z" />
                                            </svg>
                                            Detail
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus Data?');"
                                            action="{{ route('laporans.destroy', $laporan->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs flex items-center"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1H4v11a2 2 0 002 2h8a2 2 0 002-2V5h.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm1 4a.5.5 0 011 0v8a.5.5 0 01-1 0V6zm4 0a.5.5 0 011 0v8a.5.5 0 01-1 0V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                                        Belum ada laporan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
