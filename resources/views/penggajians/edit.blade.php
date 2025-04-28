<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Penggajian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('penggajians.update', $penggajian->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Karyawan -->
                        <div class="mb-4">
                            <x-input-label for="karyawan_id" :value="__('Nama Karyawan')" />
                            <select id="karyawan_id" name="karyawan_id" required
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}" {{ $penggajian->karyawan_id == $karyawan->id ? 'selected' : '' }}>
                                        {{ $karyawan->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('karyawan_id')" class="mt-2" />
                        </div>

                        <!-- Gaji Pokok -->
                        <div class="mb-4">
                            <x-input-label for="gaji_pokok" :value="__('Gaji Pokok')" />
                            <x-text-input id="gaji_pokok" class="block mt-1 w-full" type="number" name="gaji_pokok" 
                                value="{{ old('gaji_pokok', $penggajian->gaji_pokok) }}" required />
                            <x-input-error :messages="$errors->get('gaji_pokok')" class="mt-2" />
                        </div>

                        <!-- Tunjangan Transport -->
                        <div class="mb-4">
                            <x-input-label for="tunjangan_transport" :value="__('Tunjangan Transport')" />
                            <x-text-input id="tunjangan_transport" class="block mt-1 w-full" type="number" 
                                name="tunjangan_transport" value="{{ old('tunjangan_transport', $penggajian->tunjangan_transport) }}" required />
                            <x-input-error :messages="$errors->get('tunjangan_transport')" class="mt-2" />
                        </div>

                        <!-- Tunjangan Makan -->
                        <div class="mb-4">
                            <x-input-label for="tunjangan_makan" :value="__('Tunjangan Makan')" />
                            <x-text-input id="tunjangan_makan" class="block mt-1 w-full" type="number" 
                                name="tunjangan_makan" value="{{ old('tunjangan_makan', $penggajian->tunjangan_makan) }}" required />
                            <x-input-error :messages="$errors->get('tunjangan_makan')" class="mt-2" />
                        </div>

                        <!-- Tunjangan Lembur -->
                        <div class="mb-4">
                            <x-input-label for="tunjangan_lembur" :value="__('Tunjangan Lembur')" />
                            <x-text-input id="tunjangan_lembur" class="block mt-1 w-full" type="number" 
                                name="tunjangan_lembur" value="{{ old('tunjangan_lembur', $penggajian->tunjangan_lembur) }}" required />
                            <x-input-error :messages="$errors->get('tunjangan_lembur')" class="mt-2" />
                        </div>

                        <!-- Potongan -->
                        <div class="mb-4">
                            <x-input-label for="potongan" :value="__('Potongan')" />
                            <x-text-input id="potongan" class="block mt-1 w-full" type="number" name="potongan" 
                                value="{{ old('potongan', $penggajian->potongan) }}" required />
                            <x-input-error :messages="$errors->get('potongan')" class="mt-2" />
                        </div>

                        <!-- Tanggal Gajian -->
                        <div class="mb-4">
                            <x-input-label for="tanggal_gajian" :value="__('Tanggal Gajian')" />
                            <x-text-input id="tanggal_gajian" class="block mt-1 w-full" type="date" 
                                name="tanggal_gajian" value="{{ old('tanggal_gajian', $penggajian->tanggal_gajian) }}" required />
                            <x-input-error :messages="$errors->get('tanggal_gajian')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('penggajians.index') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>