<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                            Detail Profil Karyawan
                        </h3>
                        <a href="{{ route('karyawan.index') }}" 
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div>

                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Foto Profil -->
                        <div class="w-full md:w-1/3 flex flex-col items-center">
                            <div class="relative">
                                <img src="{{ $karyawan->foto ? asset('storage/' . $karyawan->foto) : asset('images/default-avatar.png') }}"
                                     alt="Foto Karyawan"
                                     class="w-64 h-64 rounded-full object-cover border-4 border-blue-500 shadow-lg">
                                <div class="absolute bottom-4 right-4 bg-{{ $karyawan->status_kepegawaian == 'aktif' ? 'green' : 'red' }}-500 text-white rounded-full p-2 shadow-lg">
                                    <i class="fas {{ $karyawan->status_kepegawaian == 'aktif' ? 'fa-check' : 'fa-times' }}"></i>
                                </div>
                            </div>
                            
                            <div class="mt-6 text-center">
                                <h4 class="text-xl font-bold text-gray-800 dark:text-white">
                                    {{ $karyawan->nama_lengkap }}
                                </h4>
                                <p class="text-blue-600 font-medium mt-1">
                                    {{ ucfirst($karyawan->jabatan) }}
                                </p>
                                <p class="text-gray-500 dark:text-gray-400 mt-2">
                                    ID: KRY{{ str_pad($karyawan->id, 4, '0', STR_PAD_LEFT) }}
                                </p>
                            </div>
                        </div>
                        
                        <!-- Detail Informasi -->
                        <div class="w-full md:w-2/3">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Informasi Pribadi -->
                                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                                        <i class="fas fa-user-circle mr-2 text-blue-500"></i>
                                        Informasi Pribadi
                                    </h4>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Tanggal Lahir</p>
                                            <p class="text-gray-800 dark:text-white font-medium">
                                                {{ \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d F Y') }}
                                            </p>
                                        </div>
                                        
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Jenis Kelamin</p>
                                            <p class="text-gray-800 dark:text-white font-medium">
                                                {{ $karyawan->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </p>
                                        </div>
                                        
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Alamat</p>
                                            <p class="text-gray-800 dark:text-white font-medium">
                                                {{ $karyawan->alamat }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Informasi Pekerjaan -->
                                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                                        <i class="fas fa-briefcase mr-2 text-blue-500"></i>
                                        Informasi Pekerjaan
                                    </h4>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Tanggal Masuk</p>
                                            <p class="text-gray-800 dark:text-white font-medium">
                                                {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d F Y') }}
                                            </p>
                                        </div>
                                        
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Status Kepegawaian</p>
                                            <span class="px-3 py-1 rounded-full text-sm font-medium 
                                                {{ $karyawan->status_kepegawaian == 'aktif' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                                {{ ucfirst($karyawan->status_kepegawaian) }}
                                            </span>
                                        </div>
                                        
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Lama Bekerja</p>
                                            <p class="text-gray-800 dark:text-white font-medium">
                                                {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->diffForHumans(\Carbon\Carbon::now(), true) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Kontak -->
                                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg md:col-span-2">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                                        <i class="fas fa-address-book mr-2 text-blue-500"></i>
                                        Kontak
                                    </h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Email</p>
                                            <p class="text-gray-800 dark:text-white font-medium flex items-center">
                                                <i class="fas fa-envelope mr-2 text-blue-500"></i>
                                                {{ $karyawan->email }}
                                            </p>
                                        </div>
                                        
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Nomor Telepon</p>
                                            <p class="text-gray-800 dark:text-white font-medium flex items-center">
                                                <i class="fas fa-phone mr-2 text-blue-500"></i>
                                                {{ $karyawan->nomor_telepon }}
                                            </p>
                                        </div>
                                        
                                        <div class="md:col-span-2 mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Akun Sistem</p>
                                            <p class="text-gray-800 dark:text-white font-medium flex items-center">
                                                <i class="fas fa-user-shield mr-2 text-blue-500"></i>
                                                {{ $karyawan->user ? $karyawan->user->roles : 'Tidak memiliki akun sistem' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            @if (Auth::user()->roles == 'admin')
                            <div class="mt-8 flex justify-end space-x-4 border-t pt-6 border-gray-200 dark:border-gray-600">
                                <a href="{{ route('karyawan.edit', $karyawan->id) }}" 
                                   class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 flex items-center">
                                    <i class="fas fa-edit mr-2"></i> Edit Profil
                                </a>
                                
                                <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 flex items-center">
                                        <i class="fas fa-trash mr-2"></i> Hapus Karyawan
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>