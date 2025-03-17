<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('karyawan.update', $karyawan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Lengkap -->
                    <div>
                        <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                        <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}" required autofocus />
                        <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                    </div>

                    <!-- Alamat -->
                    <div class="mt-4">
                        <x-input-label for="alamat" :value="__('Alamat')" />
                        <textarea id="alamat" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" name="alamat" required>{{ old('alamat', $karyawan->alamat) }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mt-4">
                        <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" />
                        <x-text-input id="nomor_telepon" class="block mt-1 w-full" type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $karyawan->nomor_telepon) }}" required />
                        <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $karyawan->email) }}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mt-4">
                        <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                        <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}" required />
                        <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                    </div>

                    <!-- Foto Karyawan -->
                    <div class="mt-4">
                        <x-input-label for="foto" :value="__('Foto Karyawan')" />
                        @if ($karyawan->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="Foto Karyawan" class="w-24 h-24 rounded-full object-cover">
                            </div>
                        @endif
                        <input id="foto" type="file" name="foto" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" accept="image/*">
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>

                    <!-- Jabatan -->
                    <div class="mt-4">
                        <x-input-label for="jabatan" :value="__('Jabatan')" />
                        <select id="jabatan" name="jabatan" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="kasir" {{ old('jabatan', $karyawan->jabatan) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                            <option value="pelayan" {{ old('jabatan', $karyawan->jabatan) == 'pelayan' ? 'selected' : '' }}>Pelayan</option>
                            <option value="chef" {{ old('jabatan', $karyawan->jabatan) == 'chef' ? 'selected' : '' }}>Chef</option>
                            <option value="manager" {{ old('jabatan', $karyawan->jabatan) == 'manager' ? 'selected' : '' }}>Manager</option>
                        </select>
                        <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                    </div>

                    <!-- Status Kepegawaian -->
                    <div class="mt-4">
                        <x-input-label for="status_kepegawaian" :value="__('Status Kepegawaian')" />
                        <select id="status_kepegawaian" name="status_kepegawaian" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="aktif" {{ old('status_kepegawaian', $karyawan->status_kepegawaian) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ old('status_kepegawaian', $karyawan->status_kepegawaian) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('status_kepegawaian')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
