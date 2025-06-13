<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Pengajuan Pergantian Jadwal
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg font-medium">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                <tr>
                                    <th class="px-4 py-3 text-left">Tanggal</th>
                                    <th class="px-4 py-3">Shift</th>
                                    <th class="px-4 py-3">Pemohon</th>
                                    <th class="px-4 py-3">Pengganti</th>
                                    <th class="px-4 py-3">Alasan</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($pengajuans as $pengajuan)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $pengajuan->jadwalKerja->tanggal }}
                                        </td>
                                        <td class="px-4 py-3 text-center capitalize">
                                            {{ $pengajuan->jadwalKerja->shift }}</td>
                                        <td class="px-4 py-3">{{ $pengajuan->jadwalKerja->karyawan->nama_lengkap }}</td>
                                        <td class="px-4 py-3">{{ $pengajuan->pengganti->nama_lengkap }}</td>
                                        <td class="px-4 py-3">{{ $pengajuan->alasan }}</td>
                                        <td class="px-4 py-3 text-center">
                                            @if ($pengajuan->status === 'diajukan')
                                                <span
                                                    class="inline-block px-3 py-1 text-xs font-semibold bg-yellow-200 text-yellow-800 rounded-full">Diajukan</span>
                                            @elseif($pengajuan->status === 'diterima')
                                                <span
                                                    class="inline-block px-3 py-1 text-xs font-semibold bg-green-200 text-green-800 rounded-full">Diterima</span>
                                            @else
                                                <span
                                                    class="inline-block px-3 py-1 text-xs font-semibold bg-red-200 text-red-800 rounded-full">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @if ($pengajuan->status == 'diajukan')
                                                <div class="flex justify-center gap-2">
                                                    <form action="{{ route('pengajuan.ubah-status', $pengajuan->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="diterima">
                                                        <button type="submit"
                                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded text-xs">Terima</button>
                                                    </form>
                                                    <form action="{{ route('pengajuan.ubah-status', $pengajuan->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="ditolak">
                                                        <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-xs">Tolak</button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-500 italic">Sudah diproses</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center px-4 py-6 text-gray-500">
                                            Belum ada pengajuan yang masuk.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
