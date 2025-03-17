<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">
                    
                    {{-- Tombol Absen Masuk/Keluar --}}
                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <form action="{{ route('absensi.checkin') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                                Absen Masuk
                            </button>
                        </form>
                        <form action="{{ route('absensi.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                                Absen Keluar
                            </button>
                        </form>
                    </div>

                    {{-- Tabel Rekap Absensi --}}
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                <tr>
                                    <th class="px-6 py-3 text-center">No</th>
                                    <th class="px-6 py-3 text-center">Nama</th>
                                    <th class="px-6 py-3 text-center">Tanggal</th>
                                    <th class="px-6 py-3 text-center">Jam Masuk</th>
                                    <th class="px-6 py-3 text-center">Jam Keluar</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($absensis as $absensi)
                                    <tr class="border-b bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-center">{{ $absensi->user->name }}</td>
                                        <td class="px-6 py-4 text-center">{{ $absensi->date }}</td>
                                        <td class="px-6 py-4 text-center">{{ $absensi->check_in }}</td>
                                        <td class="px-6 py-4 text-center">{{ $absensi->check_out ?? '-' }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium 
                                                {{ $absensi->status == 'ontime' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                                {{ ucfirst($absensi->status) }}
                                            </span>
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
                        {{ $absensis->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
