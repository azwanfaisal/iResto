<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penggajian Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">
                    {{-- Add Button --}}
                    <div class="mb-6">
                        <a href="{{ route('penggajians.create') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            + Tambah Penggajian
                        </a>
                    </div>

                    {{-- Penggajian Table --}}
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">No</th>
                                    <th scope="col" class="px-6 py-3 text-center">Nama Karyawan</th>
                                    <th scope="col" class="px-6 py-3 text-center">Gaji Pokok</th>
                                    <th scope="col" class="px-6 py-3 text-center">Tunjangan</th>
                                    <th scope="col" class="px-6 py-3 text-center">Potongan</th>
                                    <th scope="col" class="px-6 py-3 text-center">Total Gaji</th>
                                    <th scope="col" class="px-6 py-3 text-center">Tanggal Gajian</th>
                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penggajians as $penggajian)
                                    <tr class="border-b bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-center">{{ $penggajian->karyawan->nama_lengkap }}</td>
                                        <td class="px-6 py-4 text-center">Rp {{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="text-xs">
                                                <div>Transport: Rp {{ number_format($penggajian->tunjangan_transport, 0, ',', '.') }}</div>
                                                <div>Makan: Rp {{ number_format($penggajian->tunjangan_makan, 0, ',', '.') }}</div>
                                                <div>Lembur: Rp {{ number_format($penggajian->tunjangan_lembur, 0, ',', '.') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">Rp {{ number_format($penggajian->potongan, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-center font-semibold text-green-600 dark:text-green-400">
                                            Rp {{ number_format($penggajian->total_gaji, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-center">{{ \Carbon\Carbon::parse($penggajian->tanggal_gajian)->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-center space-x-2">
                                            <a href="{{ route('penggajians.edit', $penggajian->id) }}"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 text-xs">
                                                Edit
                                            </a>
                                            <form action="{{ route('penggajians.destroy', $penggajian->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data penggajian ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Data Belum Tersedia!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $penggajians->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>