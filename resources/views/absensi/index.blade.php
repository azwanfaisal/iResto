<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">
                    <div class="mb-6">
                        <a href="{{ route('absensi.create') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            + Tambah Absensi
                        </a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">No</th>
                                    <th scope="col" class="px-6 py-3 text-center">Nama Karyawan</th>
                                    <th scope="col" class="px-6 py-3 text-center">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-center">Jam Masuk</th>
                                    <th scope="col" class="px-6 py-3 text-center">Jam Pulang</th>
                                    <th scope="col" class="px-6 py-3 text-center">Status</th>
                                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($absensis as $absensi)
                                    <tr class="border-b bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-center">{{ $absensi->karyawan->nama_lengkap }}</td>
                                        <td class="px-6 py-4 text-center">{{ $absensi->tanggal->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-center">{{ $absensi->jam_masuk_formatted }}</td>
                                        <td class="px-6 py-4 text-center">{{ $absensi->jam_pulang_formatted }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-2 py-1 rounded-full text-xs 
                                                @if($absensi->status == 'hadir') bg-green-100 text-green-800
                                                @elseif($absensi->status == 'izin') bg-blue-100 text-blue-800
                                                @elseif($absensi->status == 'sakit') bg-yellow-100 text-yellow-800
                                                @elseif($absensi->status == 'cuti') bg-purple-100 text-purple-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($absensi->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center space-x-2">
                                            <a href="{{ route('absensi.edit', $absensi->id) }}"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 text-xs">
                                                Edit
                                            </a>
                                            <form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data absensi ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Data absensi belum tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $absensis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>