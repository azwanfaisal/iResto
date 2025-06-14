<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('laporans.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>Periode Awal</label>
                        <input type="date" name="periode_awal" class="w-full" required>
                    </div>

                    <div class="mb-4">
                        <label>Periode Akhir</label>
                        <input type="date" name="periode_akhir" class="w-full" required>
                    </div>

                    <div class="mb-4">
                        <label>Total Karyawan</label>
                        <input type="number" name="total_karyawan" class="w-full" required>
                    </div>

                    <div class="mb-4">
                        <label>Total Absensi</label>
                        <input type="number" name="total_absensi" class="w-full" required>
                    </div>

                    <div class="mb-4">
                        <label>Total Penggajian</label>
                        <input type="number" name="total_penggajian" class="w-full" required>
                    </div>

                    <x-primary-button class="mt-4">
                        Simpan
                    </x-primary-button>
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
