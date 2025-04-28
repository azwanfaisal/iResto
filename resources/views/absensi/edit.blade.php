<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">
                    <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Karyawan Selection -->
                            <div>
                                <x-input-label for="karyawan_id" :value="__('Nama Karyawan')" />
                                <select id="karyawan_id" name="karyawan_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    @foreach($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}" {{ old('karyawan_id', $absensi->karyawan_id) == $karyawan->id ? 'selected' : '' }}>
                                            {{ $karyawan->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('karyawan_id')" class="mt-2" />
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <x-input-label for="tanggal" :value="__('Tanggal')" />
                                <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" 
                                    value="{{ old('tanggal', $absensi->tanggal->format('Y-m-d')) }}" required />
                                <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                            </div>

                            <!-- Jam Masuk -->
                            <div>
                                <x-input-label for="jam_masuk" :value="__('Jam Masuk')" />
                                <x-text-input id="jam_masuk" name="jam_masuk" type="time" class="mt-1 block w-full" 
                                    value="{{ old('jam_masuk', $absensi->jam_masuk ? $absensi->jam_masuk : '') }}" />
                                <x-input-error :messages="$errors->get('jam_masuk')" class="mt-2" />
                            </div>

                            <!-- Jam Pulang -->
                            <div>
                                <x-input-label for="jam_pulang" :value="__('Jam Pulang')" />
                                <x-text-input id="jam_pulang" name="jam_pulang" type="time" class="mt-1 block w-full" 
                                    value="{{ old('jam_pulang', $absensi->jam_pulang ? $absensi->jam_pulang : '') }}" />
                                <x-input-error :messages="$errors->get('jam_pulang')" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-input-label for="status" :value="__('Status Kehadiran')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="hadir" {{ old('status', $absensi->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="izin" {{ old('status', $absensi->status) == 'izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="sakit" {{ old('status', $absensi->status) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="cuti" {{ old('status', $absensi->status) == 'cuti' ? 'selected' : '' }}>Cuti</option>
                                    <option value="alpa" {{ old('status', $absensi->status) == 'alpa' ? 'selected' : '' }}>Alpa</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <!-- Keterangan - Fixed Textarea -->
                            <div class="md:col-span-2">
                                <x-input-label for="keterangan" :value="__('Keterangan (Opsional)')" />
                                <textarea id="keterangan" name="keterangan" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('keterangan', $absensi->keterangan) }}</textarea>
                                <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('absensi.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200 mr-3">
                                Batal
                            </a>
                            <x-primary-button>
                                Update Data
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>