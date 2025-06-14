<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Laporan
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Periode Awal --}}
                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Periode Awal</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $laporan->periode_awal }}
                        </p>
                    </div>

                    {{-- Periode Akhir --}}
                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Periode Akhir</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $laporan->periode_akhir }}
                        </p>
                    </div>

                    {{-- Total Karyawan --}}
                    <div class="border-l-4 border-green-500 pl-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Karyawan</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $laporan->total_karyawan }}
                        </p>
                    </div>

                    {{-- Total Absensi --}}
                    <div class="border-l-4 border-yellow-500 pl-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Absensi</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $laporan->total_absensi }}
                        </p>
                    </div>

                    {{-- Total Penggajian --}}
                    <div class="border-l-4 border-red-500 pl-4 md:col-span-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Penggajian</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            Rp {{ number_format($laporan->total_penggajian, 0, ',', '.') }}
                        </p>
                    </div>

                </div>

                <div class="mt-8">
                    <a href="{{ route('laporans.index') }}"
                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                        ← Kembali ke daftar laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
