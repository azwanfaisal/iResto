<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Slip Gaji') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nama Karyawan</p>
                        <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $penggajian->karyawan->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Gajian</p>
                        <p class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($penggajian->tanggal_gajian)->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gaji Pokok</p>
                        <p class="text-lg font-medium text-gray-900 dark:text-white">
                            Rp {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tunjangan Transport</p>
                        <p class="text-lg font-medium text-gray-900 dark:text-white">
                            Rp {{ number_format($penggajian->tunjangan_transport, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tunjangan Makan</p>
                        <p class="text-lg font-medium text-gray-900 dark:text-white">
                            Rp {{ number_format($penggajian->tunjangan_makan, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tunjangan Lembur</p>
                        <p class="text-lg font-medium text-gray-900 dark:text-white">
                            Rp {{ number_format($penggajian->tunjangan_lembur, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-red-500 dark:text-red-400">Potongan</p>
                        <p class="text-lg font-medium text-red-600 dark:text-red-300">
                            Rp {{ number_format($penggajian->potongan, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-700 rounded-md p-3">
                        <p class="text-sm font-semibold text-green-800 dark:text-green-200">Total Gaji Diterima</p>
                        <p class="text-xl font-bold text-green-800 dark:text-green-100">
                            Rp {{ number_format($penggajian->total_gaji, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="mt-8 flex justify-between">
                    <a href="{{ route('penggajians.index') }}"
                        class="inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition">
                        ← Kembali
                    </a>

                    <a href="{{ route('penggajians.slip.pdf', $penggajian->id) }}"
                        target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 2a1 1 0 00-1 1v14a1 1 0 001 1h8a1 1 0 001-1V7.414A1 1 0 0014.586 6L11 2.414A1 1 0 0010.586 2H6z"/>
                        </svg>
                        Export PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
