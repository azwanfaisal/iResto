<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Penggajian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">

                    {{-- Tombol Tambah --}}
                    <div class="mb-6 flex justify-between items-center">
                        @if (Auth::user()->roles == 'admin')
                            <a href="{{ route('penggajians.create') }}"
                                class="inline-block px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
                                + Tambah Penggajian
                            </a>
                        @endif
                    </div>

                    {{-- Tabel Penggajian --}}
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                <tr>
                                    <th class="px-6 py-3 text-center">No</th>
                                    <th class="px-6 py-3 text-center">Nama Karyawan</th>
                                    <th class="px-6 py-3 text-center">Gaji Pokok</th>
                                    <th class="px-6 py-3 text-center">Tunjangan</th>
                                    <th class="px-6 py-3 text-center">Potongan</th>
                                    <th class="px-6 py-3 text-center">Total Gaji</th>
                                    <th class="px-6 py-3 text-center">Tanggal Gajian</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penggajians as $penggajian)
                                    <tr
                                        class="border-b bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-center">{{ $penggajian->karyawan->nama_lengkap }}</td>
                                        <td class="px-6 py-4 text-center">
                                            Rp {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-center text-xs space-y-1">
                                            <div>Transport: Rp
                                                {{ number_format($penggajian->tunjangan_transport, 0, ',', '.') }}</div>
                                            <div>Makan: Rp
                                                {{ number_format($penggajian->tunjangan_makan, 0, ',', '.') }}</div>
                                            <div>Lembur: Rp
                                                {{ number_format($penggajian->tunjangan_lembur, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            Rp {{ number_format($penggajian->potongan, 0, ',', '.') }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-center font-semibold text-green-600 dark:text-green-400">
                                            Rp {{ number_format($penggajian->total_gaji, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ \Carbon\Carbon::parse($penggajian->tanggal_gajian)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if ($penggajian->status == 'dibayar')
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold rounded bg-green-200 text-green-800">
                                                    Dibayar
                                                </span>
                                            @elseif ($penggajian->status == 'belum dibayar')
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold rounded bg-yellow-200 text-yellow-800">
                                                    Belum Dibayar
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold rounded bg-red-200 text-red-800">
                                                    {{ ucfirst($penggajian->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex flex-col items-center space-y-2">

                                                {{-- Tombol Slip Gaji --}}
                                                <a href="{{ route('penggajians.slip', $penggajian->id) }}"
                                                    class="flex items-center px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 text-xs"
                                                    title="Lihat Slip Gaji">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                        viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="M6 2a1 1 0 00-1 1v14a1 1 0 001 1h8a1 1 0 001-1V7.414A1 1 0 0014.586 6L11 2.414A1 1 0 0010.586 2H6z" />
                                                    </svg>
                                                    Slip
                                                </a>
                                                @if (Auth::user()->roles == 'admin')
                                                    {{-- Tombol Bayar --}}
                                                    <form action="{{ route('penggajians.bayar', $penggajian->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin membayar gaji ini?');">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="flex items-center px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 text-xs"
                                                            title="Bayar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 8c-1.1 0-2 .9-2 2s.9 2 2 2m0 0c1.1 0 2 .9 2 2s-.9 2-2 2m0-4v.01M21 12c0 4.97-4.03 9-9 9S3 16.97 3 12 7.03 3 12 3s9 4.03 9 9z" />
                                                            </svg>
                                                            Bayar
                                                        </button>
                                                    </form>

                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ route('penggajians.destroy', $penggajian->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="flex items-center px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs"
                                                            title="Hapus">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1H4v11a2 2 0 002 2h8a2 2 0 002-2V5h.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm1 4a.5.5 0 011 0v8a.5.5 0 01-1 0V6zm4 0a.5.5 0 011 0v8a.5.5 0 01-1 0V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                            Data belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $penggajians->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
