<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Jadwal Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('jadwalkerja.update', $jadwalkerja->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Karyawan -->
                            <div>
                                <label for="karyawan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Karyawan</label>
                                <select name="karyawan_id" id="karyawan_id" 
                                        class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                        required
                                        onchange="updatePosisi(this)">
                                    @foreach($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}" 
                                                data-posisi="{{ $karyawan->jabatan }}"
                                                {{ $jadwalkerja->karyawan_id == $karyawan->id ? 'selected' : '' }}>
                                            {{ $karyawan->nama_lengkap }} - {{ $karyawan->jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" 
                                       value="{{ $jadwalkerja->tanggal }}" 
                                       class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                       required>
                            </div>

                            <!-- Shift -->
                            <div>
                                <label for="shift" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Shift</label>
                                <select name="shift" id="shift" 
                                        class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                        required>
                                    <option value="pagi" {{ $jadwalkerja->shift == 'pagi' ? 'selected' : '' }}>Pagi</option>
                                    <option value="siang" {{ $jadwalkerja->shift == 'siang' ? 'selected' : '' }}>Siang</option>
                                    <option value="malam" {{ $jadwalkerja->shift == 'malam' ? 'selected' : '' }}>Malam</option>
                                </select>
                            </div>

                            <!-- Posisi (Akan diisi otomatis) -->
                            <div>
                                <label for="posisi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Posisi</label>
                                <input type="text" name="posisi" id="posisi" 
                                       value="{{ $jadwalkerja->posisi }}" 
                                       class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500 bg-gray-100 dark:bg-gray-600" 
                                       readonly required>
                               
                            </div>
                        </div>

                        <div class="flex justify-end mt-6 space-x-3">
                            <a href="{{ route('jadwalkerja.index') }}" 
                               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updatePosisi(select) {
            const selectedOption = select.options[select.selectedIndex];
            const posisi = selectedOption.getAttribute('data-posisi');
            document.getElementById('posisi').value = posisi || '';
        }

        // Inisialisasi posisi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('karyawan_id');
            if (select) {
                updatePosisi(select);
            }
        });
    </script>
</x-app-layout>