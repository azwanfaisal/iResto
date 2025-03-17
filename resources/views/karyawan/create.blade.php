<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data">
                    @csrf                

                    <!-- Nama Lengkap -->
                    <div>
                        <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                        <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" :value="old('nama_lengkap')" required autofocus />
                        <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                    </div>

                    <!-- Alamat -->
                    <div class="mt-4">
                        <x-input-label for="alamat" :value="__('Alamat')" />
                        <textarea id="alamat" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" name="alamat" required>{{ old('alamat') }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mt-4">
                        <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" />
                        <x-text-input id="nomor_telepon" class="block mt-1 w-full" type="text" name="nomor_telepon" :value="old('nomor_telepon')" required />
                        <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mt-4">
                        <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                        <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required />
                        <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                    </div>

                    <!-- Foto Karyawan -->
                    <div class="mt-4">
                        <x-input-label for="foto" :value="__('Foto Karyawan')" />
                        <input id="foto" type="file" name="foto" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" accept="image/*">
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>

                    <!-- Jabatan -->
                    <div class="mt-4">
                        <x-input-label for="jabatan" :value="__('Jabatan')" />
                        <select id="jabatan" name="jabatan" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="kasir">Kasir</option>
                            <option value="pelayan">Pelayan</option>
                            <option value="chef">Chef</option>
                            <option value="manager">Manager</option>
                        </select>
                        <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                    </div>

                    <!-- Status Kepegawaian -->
                    <div class="mt-4">
                        <x-input-label for="status_kepegawaian" :value="__('Status Kepegawaian')" />
                        <select id="status_kepegawaian" name="status_kepegawaian" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('status_kepegawaian')" class="mt-2" />
                    </div>
                    <div>
                        <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
