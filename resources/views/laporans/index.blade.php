<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">
                    {{-- Add Button --}}
                    <div class="mb-6">
                        <a href="{{ route('laporans.create') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            + Tambah Laporan
                        </a>
                    </div>

                    {{-- Laporan Table --}}
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">No</th>
                                    <th scope="col" class="px-6 py-3 text-center">Judul</th>
                                    <th scope="col" class="px-6 py-3 text-center">Jenis Laporan</th>
                                    <th scope="col" class="px-6 py-3 text-center">Periode Awal</th>
                                    <th scope="col" class="px-6 py-3 text-center">Periode Akhir</th>
                                    <th scope="col" class="px-6 py-3 text-center">Format</th>
                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporans as $laporan)
                                    <tr class="border-b bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-center">{{ $laporan->judul }}</td>
                                        <td class="px-6 py-4 text-center">{{ ucfirst($laporan->jenis_laporan) }}</td>
                                        <td class="px-6 py-4 text-center">{{ $laporan->periode_awal }}</td>
                                        <td class="px-6 py-4 text-center">{{ $laporan->periode_akhir }}</td>
                                        <td class="px-6 py-4 text-center">{{ $laporan->format }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('laporans.edit', $laporan->id) }}"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 text-xs">
                                                Edit
                                            </a>
                                            <form action="{{ route('laporans.destroy', $laporan->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Data Belum Tersedia!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $laporans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>