<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">

                    {{-- Filter & Add Button --}}
                    <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
                        <form action="{{ route('karyawan.index') }}" method="GET" class="flex flex-wrap gap-2">
                            <input type="text" name="search" placeholder="Cari nama atau email..."
                                value="{{ request('search') }}"
                                class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300" />

                            <select name="jabatan"
                                class="px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                                <option value="">All</option>
                                <option value="kasir" {{ request('jabatan') == 'kasir' ? 'selected' : '' }}>Kasir
                                </option>
                                <option value="pelayan" {{ request('jabatan') == 'pelayan' ? 'selected' : '' }}>Pelayan
                                </option>
                                <option value="chef" {{ request('jabatan') == 'chef' ? 'selected' : '' }}>Chef
                                </option>
                                <option value="manager" {{ request('jabatan') == 'manager' ? 'selected' : '' }}>Manager
                                </option>
                            </select>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                        </form>

                        <a href="{{ route('karyawan.create') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i> Tambah Karyawan
                        </a>
                    </div>

                    {{-- Employee Table --}}
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        @if ($karyawans->count() > 0)
                            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                                <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">No</th>
                                        <th scope="col" class="px-6 py-3 text-center">Karyawan</th>
                                        <th scope="col" class="px-6 py-3 text-center">Email</th>
                                        <th scope="col" class="px-6 py-3 text-center">Jabatan</th>
                                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                                        @if (Auth::user()->roles == 'admin')
                                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawans as $key => $item)
                                        <tr
                                            class="border-b bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                                            <td class="px-6 py-4 text-center">
                                                {{ ($karyawans->currentPage() - 1) * $karyawans->perPage() + $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-3">
                                                    <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/default-avatar.png') }}"
                                                        alt="Foto Karyawan" class="w-10 h-10 rounded-full object-cover">
                                                    <div>
                                                        <span
                                                            class="font-medium text-gray-900 dark:text-gray-200 block">{{ $item->nama_lengkap }}</span>
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">ID:
                                                            {{ $item->id }}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 text-center">{{ $item->email }}</td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs 
                                                    {{ $item->jabatan == 'manager' ? 'bg-purple-200 text-purple-800' : '' }}
                                                    {{ $item->jabatan == 'kasir' ? 'bg-blue-200 text-blue-800' : '' }}
                                                    {{ $item->jabatan == 'pelayan' ? 'bg-green-200 text-green-800' : '' }}
                                                    {{ $item->jabatan == 'chef' ? 'bg-orange-200 text-orange-800' : '' }}">
                                                    {{ ucfirst($item->jabatan) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-medium 
                                                    {{ $item->status_kepegawaian == 'aktif' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                                    {{ ucfirst($item->status_kepegawaian) }}
                                                </span>
                                            </td>
                                            @if (Auth::user()->roles == 'admin')
                                                <td class="px-6 py-4">
                                                    <div class="flex justify-center space-x-2">
                                                        <a href="{{ route('karyawan.show', $item->id) }}"
                                                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 text-xs flex items-center"
                                                            title="Detail">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path
                                                                    d="M10 3.5c-4.837 0-9 3.582-9 6.5s4.163 6.5 9 6.5 9-3.582 9-6.5-4.163-6.5-9-6.5zM10 14.5c-2.485 0-4.5-2.015-4.5-4.5S7.515 5.5 10 5.5s4.5 2.015 4.5 4.5-2.015 4.5-4.5 4.5zM10 7a3 3 0 100 6 3 3 0 000-6z" />
                                                            </svg>
                                                            Detail
                                                        </a>


                                                        <a href="{{ route('karyawan.edit', $item->id) }}"
                                                            class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 text-xs flex items-center"
                                                            title="Edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path
                                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                            </svg>
                                                            Edit
                                                        </a>


                                                        <form
                                                            onsubmit="return confirm('Apakah Anda Yakin Menghapus Data?');"
                                                            action="{{ route('karyawan.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs flex items-center"
                                                                title="Hapus">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                                                    fill="currentColor">
                                                                    <path fill-rule="evenodd"
                                                                        d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1H4v11a2 2 0 002 2h8a2 2 0 002-2V5h.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm1 4a.5.5 0 011 0v8a.5.5 0 01-1 0V6zm4 0a.5.5 0 011 0v8a.5.5 0 01-1 0V6z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                Hapus
                                                            </button>

                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-8 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-700 dark:text-gray-300">Belum Ada Data
                                    Karyawan</h3>
                                <p class="mt-2 text-gray-500 dark:text-gray-400">
                                    Mulai tambahkan karyawan baru untuk mengelola tim Anda.
                                </p>
                                <div class="mt-6">
                                    <a href="{{ route('karyawan.create') }}"
                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 inline-flex items-center">
                                        <i class="fas fa-plus-circle mr-2"></i> Tambah Karyawan
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Pagination --}}
                    @if ($karyawans->hasPages())
                        <div class="mt-4">
                            {{ $karyawans->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
