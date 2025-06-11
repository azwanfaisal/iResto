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
                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <form action="{{ route('karyawan.index') }}" method="GET" class="flex space-x-2">
                            <input type="text" name="search" placeholder="Cari karyawan..."
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
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                Filter
                            </button>
                        </form>

                        <a href="{{ route('karyawan.create') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            + Add Karyawan
                        </a>
                    </div>

                    {{-- Employee Table --}}
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">No</th>
                                    <th scope="col" class="px-6 py-3 text-center">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-center">Email</th>
                                    <th scope="col" class="px-6 py-3 text-center">Jabatan</th>
                                    <th scope="col" class="px-6 py-3 text-center">Status</th>
                                    @if (Auth::user()->roles == 'admin')
                                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($karyawans as $key => $item)
                                    <tr
                                        class="border-b bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                                        <td class="px-6 py-4 text-center">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4 flex items-center space-x-3">
                                            <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/default-avatar.png') }}"
                                                alt="Foto Karyawan" class="w-12 h-12 rounded-full object-cover">
                                            <span
                                                class="font-medium text-gray-900 dark:text-gray-200">{{ $item->nama_lengkap }}</span>
                                        </td>

                                        <td class="px-6 py-4 text-center">{{ $item->email }}</td>
                                        <td class="px-6 py-4 text-center">{{ ucfirst($item->jabatan) }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium 
                                                {{ $item->status_kepegawaian == 'aktif' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                                {{ ucfirst($item->status_kepegawaian) }}
                                            </span>
                                        </td>
                                        @if (Auth::user()->roles == 'admin')
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <!-- Tombol View Detail -->
                                                    <a href="{{ route('karyawan.show', $item->id) }}"
                                                        class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 text-xs">
                                                        View
                                                    </a>


                                                    <a href="{{ route('karyawan.edit', $item->id) }}"
                                                        class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 text-xs">
                                                        Edit
                                                    </a>

                                                    <form onsubmit="return confirm('Apakah Anda Yakin?');"
                                                        action="{{ route('karyawan.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Data Belum
                                            Tersedia!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $karyawans->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
