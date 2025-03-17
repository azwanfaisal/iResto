<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Jadwal Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('jadwalkerja.store') }}">
                        @csrf

                        <!-- Nama Karyawan -->
                        <div>
                            <x-input-label for="karyawan_id" :value="__('Nama Karyawan')" />
                            <select id="karyawan_id" name="karyawan_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}" data-jabatan="{{ $karyawan->jabatan }}">
                                        {{ $karyawan->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('karyawan_id')" class="mt-2" />
                        </div>

                        <!-- Posisi (Otomatis Terisi) -->
                        <div class="mt-4">
                            <x-input-label for="posisi" :value="__('Posisi')" />
                            <x-text-input id="posisi" class="block mt-1 w-full" type="text" name="posisi" readonly />
                            <x-input-error :messages="$errors->get('posisi')" class="mt-2" />
                        </div>

                        <!-- Status Kepegawaian -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="">-- Pilih Status --</option>
                                <option value="terjadwal">Terjadwal</option>
                                <option value="diganti">Diganti</option>
                                <option value="dikonfirmasi">Dikonfirmasi</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Tanggal -->
                        <div class="mt-4">
                            <x-input-label for="tanggal" :value="__('Tanggal')" />
                            <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" required />
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>

                        <!-- Shift -->
                        <div class="mt-4">
                            <x-input-label for="shift" :value="__('Shift')" />
                            <select id="shift" name="shift" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="pagi">Pagi</option>
                                <option value="siang">Siang</option>
                                <option value="malam">Malam</option>
                            </select>
                            <x-input-error :messages="$errors->get('shift')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('jadwalkerja.index')">
                                {{ __('Back') }}
                            </x-danger-link-button>
                            <x-primary-button class="ms-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Mengisi Posisi Otomatis -->
    <script>
        document.getElementById('karyawan_id').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let posisiInput = document.getElementById('posisi');
            
            // Ambil jabatan dari attribute data-jabatan
            let jabatan = selectedOption.getAttribute('data-jabatan') || '';

            // Isi otomatis input posisi
            posisiInput.value = jabatan;
        });
    </script>
</x-app-layout>
