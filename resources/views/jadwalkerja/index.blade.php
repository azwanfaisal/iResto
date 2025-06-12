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
                    <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
                        <form action="{{ route('jadwalkerja.index') }}" method="GET" class="flex flex-wrap gap-2">
                            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300" />

                            <select name="shift"
                                class="px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                                <option value="">All</option>
                                <option value="pagi" {{ request('shift') == 'pagi' ? 'selected' : '' }}>Pagi</option>
                                <option value="siang" {{ request('shift') == 'siang' ? 'selected' : '' }}>Siang
                                </option>
                                <option value="malam" {{ request('shift') == 'malam' ? 'selected' : '' }}>Malam
                                </option>
                                <option value="off" {{ request('shift') == 'off' ? 'selected' : '' }}>Off</option>
                            </select>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                Filter
                            </button>
                        </form>

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('jadwalkerja.create') }}"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Jadwal Harian
                            </a>
                            <a href="{{ route('jadwalkerja.create-weekly') }}"
                                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Jadwal Mingguan
                            </a>
                        </div>
                    </div>

                    {{-- Jadwal Kerja Table --}}
                    <div class="relative overflow-x-auto shadow-md rounded-lg">
                        @if ($jadwalKerja->count() > 0)
                            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                                <thead class="text-md text-white bg-blue-600 dark:bg-blue-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">No</th>
                                        <th scope="col" class="px-6 py-3 text-center">Tanggal</th>
                                        <th scope="col" class="px-6 py-3 text-center">Nama Karyawan</th>
                                        <th scope="col" class="px-6 py-3 text-center">Shift</th>
                                        <th scope="col" class="px-6 py-3 text-center">Posisi</th>
                                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwalKerja as $key => $jadwal)
                                        <tr
                                            class="border-b bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-200">
                                            <td class="px-6 py-4 text-center">
                                                {{ ($jadwalKerja->currentPage() - 1) * $jadwalKerja->perPage() + $loop->index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
                                            <td class="px-6 py-4 text-center">{{ $jadwal->karyawan->nama_lengkap }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs 
                                                        {{ $jadwal->shift == 'pagi' ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $jadwal->shift == 'siang' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                        {{ $jadwal->shift == 'malam' ? 'bg-purple-100 text-purple-800' : '' }}
                                                        {{ $jadwal->shift == 'off' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ ucfirst($jadwal->shift) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">{{ ucfirst($jadwal->posisi) }}</td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs 
                                                        {{ $jadwal->status == 'terjadwal' ? 'bg-blue-200 text-blue-800' : '' }}
                                                        {{ $jadwal->status == 'dikonfirmasi' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                                        {{ $jadwal->status == 'diganti' ? 'bg-green-200 text-green-800' : '' }}">
                                                    {{ ucfirst($jadwal->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    @if ($jadwal->status == 'terjadwal')
                                                        <a href="{{ route('jadwalkerja.ajukan-pergantian', $jadwal->id) }}"
                                                            class="px-3 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200 text-xs flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path
                                                                    d="M10.707 15.707a1 1 0 01-1.414 0L6 12.414V14a1 1 0 11-2 0V10a1 1 0 011-1h4a1 1 0 110 2H7.414l3.293 3.293a1 1 0 010 1.414z" />
                                                            </svg>
                                                            Ajukan
                                                        </a>
                                                    @endif

                                                    <a href="{{ route('jadwalkerja.edit', $jadwal->id) }}"
                                                        class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 text-xs flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form
                                                        onsubmit="return confirm('Apakah Anda yakin menghapus jadwal ini?');"
                                                        action="{{ route('jadwalkerja.destroy', $jadwal->id) }}"
                                                        method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-xs flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-8 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-700 dark:text-gray-300">Belum Ada Jadwal
                                    Kerja</h3>
                                <p class="mt-2 text-gray-500 dark:text-gray-400">
                                    Mulai tambahkan jadwal harian atau buat jadwal mingguan untuk mengisi kalender
                                    kerja.
                                </p>
                                <div class="mt-6 flex justify-center gap-4">
                                    <a href="{{ route('jadwalkerja.create') }}"
                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                                        + Tambah Jadwal Harian
                                    </a>
                                    <a href="{{ route('jadwalkerja.create-weekly') }}"
                                        class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                                        + Buat Jadwal Mingguan
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Pagination --}}
                    @if ($jadwalKerja->hasPages())
                        <div class="mt-4">
                            {{ $jadwalKerja->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
