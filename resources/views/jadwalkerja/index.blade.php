<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Jadwal Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">
                    
                    {{-- Filter & Add Button --}}
                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <form action="{{ route('jadwalkerja.index') }}" method="GET" class="flex space-x-2">
                            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                                class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300" />
                            
                            <select name="shift" class="px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                                <option value="">All</option>
                                <option value="pagi" {{ request('shift') == 'pagi' ? 'selected' : '' }}>Pagi</option>
                                <option value="siang" {{ request('shift') == 'siang' ? 'selected' : '' }}>Siang</option>
                                <option value="malam" {{ request('shift') == 'malam' ? 'selected' : '' }}>Malam</option>
                            </select>

                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                Filter
                            </button>
                        </form>

                        <a href="{{ route('jadwalkerja.create') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            + Tambah Jadwal
                        </a>
                    </div>

                    {{-- Jadwal Kerja Table --}}
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">No</th>
                                    <th scope="col" class="px-6 py-3 text-center">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-center">Id Karyawan</th>
                                    <th scope="col" class="px-6 py-3 text-center">Shift</th>
                                    <th scope="col" class="px-6 py-3 text-center">Posisi</th>
                                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwalKerja as $key => $jadwal)
                                <tr class="border-b bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                                    <td class="px-6 py-4 text-center">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 text-center">{{ $jadwal->tanggal }}</td>
                                    <td class="px-6 py-4 text-center">{{ $jadwal->karyawan_id }}</td> <!-- Mengganti nama dengan ID -->
                                    <td class="px-6 py-4 text-center">{{ ucfirst($jadwal->shift) }}</td>
                                    <td class="px-6 py-4 text-center">{{ ucfirst($jadwal->posisi) }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('jadwalkerja.edit', $jadwal->id) }}"
                                            class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 text-xs">
                                            Edit
                                        </a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin?');"
                                            action="{{ route('jadwalkerja.destroy', $jadwal->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Data Belum Tersedia!</td>
                                </tr>
                            @endforelse
                            
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $jadwalKerja->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
