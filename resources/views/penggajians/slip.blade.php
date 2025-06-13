<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Slip Gaji') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg px-8 py-6 dark:bg-gray-800 dark:text-white">

            {{-- Header Slip Gaji --}}
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Slip Gaji - {{ $penggajian->karyawan->nama_lengkap }}</h3>
                <a href="{{ route('penggajians.slip.pdf', $penggajian->id) }}"
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 00-1 1v14a1 1 0 001 1h8a1 1 0 001-1V7.414A1 1 0 0014.586 6L11 2.414A1 1 0 0010.586 2H6z"/>
                    </svg>
                    Export PDF
                </a>
            </div>

            {{-- Tabel Slip --}}
            <table class="w-full text-sm border border-gray-300 dark:border-gray-700">
                <tbody>
                    <tr class="border-b">
                        <td class="font-medium p-2">Nama Karyawan</td>
                        <td class="p-2">{{ $penggajian->karyawan->nama_lengkap }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-medium p-2">Tanggal Gajian</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($penggajian->tanggal_gajian)->format('d M Y') }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-medium p-2">Gaji Pokok</td>
                        <td class="p-2">Rp {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-medium p-2">Tunjangan Transport</td>
                        <td class="p-2">Rp {{ number_format($penggajian->tunjangan_transport, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-medium p-2">Tunjangan Makan</td>
                        <td class="p-2">Rp {{ number_format($penggajian->tunjangan_makan, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-medium p-2">Tunjangan Lembur</td>
                        <td class="p-2">Rp {{ number_format($penggajian->tunjangan_lembur, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-medium p-2 text-red-600">Potongan</td>
                        <td class="p-2 text-red-600">Rp {{ number_format($penggajian->potongan, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="bg-green-100 dark:bg-green-700 font-bold text-green-800 dark:text-green-100">
                        <td class="p-2">Total Gaji Diterima</td>
                        <td class="p-2">Rp {{ number_format($penggajian->total_gaji, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
