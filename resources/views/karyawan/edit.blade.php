<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom kiri -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="foto">
                                    Foto Profil
                                </label>
                                @if ($karyawan->foto)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="Foto Profil"
                                            class="w-24 h-24 rounded-full object-cover border">
                                    </div>
                                @endif
                                <input type="file" name="foto" id="foto"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    accept="image/*">
                                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto</p>
                                @error('foto')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_lengkap">
                                    Nama Lengkap
                                </label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                    Email
                                </label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $karyawan->email) }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_lahir">
                                    Tanggal Lahir
                                </label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                   value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('Y-m-d')) }}"

                                    required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>

                        <!-- Kolom kanan -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="nomor_telepon">
                                    Nomor Telepon
                                </label>
                                <input type="text" name="nomor_telepon" id="nomor_telepon"
                                    value="{{ old('nomor_telepon', $karyawan->nomor_telepon) }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="jabatan">
                                    Jabatan
                                </label>
                                <select name="jabatan" id="jabatan" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="kasir" {{ $karyawan->jabatan == 'kasir' ? 'selected' : '' }}>Kasir
                                    </option>
                                    <option value="pelayan" {{ $karyawan->jabatan == 'pelayan' ? 'selected' : '' }}>
                                        Pelayan</option>
                                    <option value="chef" {{ $karyawan->jabatan == 'chef' ? 'selected' : '' }}>Chef
                                    </option>
                                    <option value="manager" {{ $karyawan->jabatan == 'manager' ? 'selected' : '' }}>
                                        Manager</option>
                                    <option value="lainnya" {{ $karyawan->jabatan == 'lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="status_kepegawaian">
                                    Status Kepegawaian
                                </label>
                                <select name="status_kepegawaian" id="status_kepegawaian" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="aktif"
                                        {{ $karyawan->status_kepegawaian == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="tidak aktif"
                                        {{ $karyawan->status_kepegawaian == 'tidak aktif' ? 'selected' : '' }}>Tidak
                                        Aktif</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_masuk">
                                    Tanggal Masuk
                                </label>
                                <input type="date" name="tanggal_masuk" id="tanggal_masuk"
                                  value="{{ old('tanggal_masuk', \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('Y-m-d')) }}"

                                    required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">
                            Alamat
                        </label>
                        <textarea name="alamat" id="alamat" required rows="3"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('alamat', $karyawan->alamat) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
