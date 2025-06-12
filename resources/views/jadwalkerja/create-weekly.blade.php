<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Jadwal Mingguan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('jadwalkerja.storeWeekly') }}">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Minggu: {{ $dates->first()->format('d M') }} - {{ $dates->last()->format('d M Y') }}
                            </label>

                            <div class="overflow-x-auto">
                                <table class="min-w-full border-collapse">
                                    <thead>
                                        <tr class="bg-gray-200 dark:bg-gray-700">
                                            <th class="border py-2 px-4">Karyawan</th>
                                            @foreach ($dates as $date)
                                                <th class="border py-2 px-4 text-center">
                                                    {{ $date->format('D') }}<br>
                                                    {{ $date->format('d M') }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawans as $karyawan)
                                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <td class="border py-3 px-4">
                                                    {{ $karyawan->nama_lengkap }}<br>
                                                    <span class="text-sm text-gray-500">{{ $karyawan->jabatan }}</span>
                                                </td>
                                                @foreach ($dates as $date)
                                                    <td class="border py-2 px-3">
                                                        <select
                                                            name="jadwal[{{ $karyawan->id }}][{{ $date->format('Y-m-d') }}][shift]"
                                                            class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-gray-300">
                                                            <option value="">-</option>
                                                            <option value="pagi">Pagi</option>
                                                            <option value="siang">Siang</option>
                                                            <option value="malam">Malam</option>
                                                            <option value="off">Off</option>
                                                        </select>
                                                        <input type="hidden"
                                                            name="jadwal[{{ $karyawan->id }}][{{ $date->format('Y-m-d') }}][posisi]"
                                                            value="{{ $karyawan->jabatan }}">
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('jadwalkerja.index') }}"
                                class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                                Simpan Jadwal Mingguan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
