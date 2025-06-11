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
                    {{-- Action Buttons --}}
                    <div class="mb-6 flex space-x-2">
                        <button type="button"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                            Filter
                        </button>
                        <button type="button"
                            class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition duration-200">
                            Proses
                        </button>
                        <button type="button"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                            Export PDF
                        </button>
                        <button type="button"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            Export Excel
                        </button>
                    </div>

                    {{-- Rest of the table and content remains the same --}}
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
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
                                        <td class="px-6 py-4 text-center">{{ $laporan->jenis_display }}</td>
                                        <td class="px-6 py-4 text-center">{{ $laporan->periode_awal->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-center">{{ $laporan->periode_akhir->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-center">{{ $laporan->format_display }}</td>
                                        <td class="px-6 py-4 text-center space-x-2">
                                            @if($laporan->file_path)
                                                <a href="{{ route('laporans.download', $laporan) }}" 
                                                   class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 text-xs">
                                                    Download
                                                </a>
                                            @endif
                                            <a href="{{ route('laporans.edit', $laporan) }}"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 text-xs">
                                                Edit
                                            </a>
                                            <form action="{{ route('laporans.destroy', $laporan) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Data Belum Tersedia!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $laporans->links() }}
                    </div>
                        </table>
                    </div>

                    {{-- Pagination remains the same --}}
                    <div class="mt-4">
                        {{ $laporans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
      
</x-app-layout>