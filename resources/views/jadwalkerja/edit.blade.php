<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Jadwal Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('jadwalkerja.update', $jadwal->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nama Karyawan -->
                        <div>
                            <x-input-label for="karyawan_id" :value="__('Nama Karyawan')" />
                            <select id="karyawan_id" name="karyawan_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}" data-jabatan="{{ $karyawan->jabatan }}"
                                        {{ $jadwal->karyawan_id == $karyawan->id ? 'selected' : '' }}>
                                        {{ $karyawan->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('karyawan_id')" class="mt-2" />
                        </div>

                        <!-- Posisi (Otomatis Terisi) -->
                        <div class="mt-4">
                            <x-input-label for="posisi" :value="__('Posisi')" />
                            <x-text-input id="posisi" class="block mt-1 w-full" type="text" name="posisi" 
                                value="{{ old('posisi', $jadwal->posisi) }}" readonly />
                            <x-input-error :messages="$errors->get('posisi')" class="mt-2" />
                        </div>

                        <!-- Status Kepegawaian -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="">-- Pilih Status --</option>
                                <option value="terjadwal" {{ $jadwal->status == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                                <option value="diganti" {{ $jadwal->status == 'diganti' ? 'selected' : '' }}>Diganti</option>
                                <option value="dikonfirmasi" {{ $jadwal->status == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Tanggal -->
                        <div class="mt-4">
                            <x-input-label for="tanggal" :value="__('Tanggal')" />
                            <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" 
                                value="{{ old('tanggal', $jadwal->tanggal) }}" required />
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>

                        <!-- Shift -->
                        <div class="mt-4">
                            <x-input-label for="shift" :value="__('Shift')" />
                            <select id="shift" name="shift" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="pagi" {{ $jadwal->shift == 'pagi' ? 'selected' : '' }}>Pagi</option>
                                <option value="siang" {{ $jadwal->shift == 'siang' ? 'selected' : '' }}>Siang</option>
                                <option value="malam" {{ $jadwal->shift == 'malam' ? 'selected' : '' }}>Malam</option>
                            </select>
                            <x-input-error :messages="$errors->get('shift')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('jadwalkerja.index')">
                                {{ __('Back') }}
                            </x-danger-link-button>
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Mengisi Posisi Otomatis -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set posisi awal berdasarkan data yang sudah ada
            let karyawanSelect = document.getElementById('karyawan_id');
            let posisiInput = document.getElementById('posisi');
            
            // Set posisi saat pertama kali load
            if (karyawanSelect.selectedIndex > 0) {
                let selectedOption = karyawanSelect.options[karyawanSelect.selectedIndex];
                posisiInput.value = selectedOption.getAttribute('data-jabatan') || '';
            }

            // Event listener untuk perubahan
            karyawanSelect.addEventListener('change', function() {
                let selectedOption = this.options[this.selectedIndex];
                posisiInput.value = selectedOption.getAttribute('data-jabatan') || '';
            });
        });
    </script>
</x-app-layout>