<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Absensi') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="py-6 px-6">
                    <div class="flex justify-between items-center mb-4">
                        @if (Auth::user()->roles == 'user')
                            <div>
                                <form action="{{ route('absensi.masuk') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                                        Absen Masuk
                                    </button>
                                </form>

                                <form action="{{ route('absensi.pulang') }}" method="POST" class="inline ml-2">
                                    @csrf
                                    <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
                                        Absen Pulang
                                    </button>
                                </form>
                            </div>

                            <div>
                                <a href="{{ route('absensi.qr') }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">
                                    📷 Scan QR Code
                                </a>
                            </div>
                            <a href="{{ route('absensi.formPengajuan') }}"
                                class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow text-sm">
                                📝 Ajukan Izin/Sakit/Cuti
                            </a>
                        @endif
                        <a href="{{ route('absensi.rekapBulanan') }}"
                            class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg text-sm shadow-sm transition">
                            📊 Rekap Absensi
                        </a>


                    </div>

                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                            <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                <tr>
                                    <th class="px-6 py-3 text-center">No</th>
                                    <th class="px-6 py-3 text-center">Nama Karyawan</th>
                                    <th class="px-6 py-3 text-center">Tanggal</th>
                                    <th class="px-6 py-3 text-center">Jam Masuk</th>
                                    <th class="px-6 py-3 text-center">Jam Pulang</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($absensis as $absensi)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150">
                                        <td class="px-6 py-4 text-center">
                                            {{ $loop->iteration + ($absensis->currentPage() - 1) * $absensis->perPage() }}
                                        </td>
                                        <td class="px-6 py-4 text-center">{{ $absensi->karyawan->nama_lengkap }}</td>
                                        <td class="px-6 py-4 text-center">
                                            {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $absensi->jam_masuk ? \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $absensi->jam_pulang ? \Carbon\Carbon::parse($absensi->jam_pulang)->format('H:i') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                                                @switch($absensi->status)
                                                    @case('hadir') bg-green-100 text-green-800 @break
                                                    @case('izin') bg-blue-100 text-blue-800 @break
                                                    @case('sakit') bg-yellow-100 text-yellow-800 @break
                                                    @case('cuti') bg-purple-100 text-purple-800 @break
                                                    @default bg-red-100 text-red-800
                                                @endswitch">
                                                {{ ucfirst($absensi->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            Data absensi belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $absensis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
