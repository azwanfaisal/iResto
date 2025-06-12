<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ajukan Pergantian Jadwal
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="px-8 py-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 5a2 2 0 012-2h1.586a1 1 0 01.707.293l1.414 1.414A1 1 0 008.414 5H16a2 2 0 012 2v1H2V5z" />
                        <path d="M2 9h16v6a2 2 0 01-2 2H4a2 2 0 01-2-2V9z" />
                    </svg>
                    Detail Jadwal
                </h3>

                {{-- Informasi Jadwal --}}
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                        <span class="font-medium">Tanggal:</span> {{ $jadwal->tanggal }}<br>
                        <span class="font-medium">Shift:</span> {{ ucfirst($jadwal->shift) }}<br>
                        <span class="font-medium">Karyawan:</span> {{ $jadwal->karyawan->nama_lengkap }}
                    </p>
                </div>

                {{-- Form --}}
                <form action="{{ route('jadwalkerja.simpan-pergantian', $jadwal->id) }}" method="POST">
                    @csrf

                    {{-- Pilih Pengganti --}}
                    <div class="mb-6">
                        <label for="pengganti_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pilih Karyawan Pengganti:
                        </label>
                        <select id="pengganti_id" name="pengganti_id" required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Pengganti --</option>
                            @foreach ($karyawans as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Alasan Pergantian --}}
                    <div class="mb-6">
                        <label for="alasan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Alasan Pergantian Jadwal:
                        </label>
                        <textarea id="alasan" name="alasan" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tuliskan alasan mengapa Anda ingin mengganti jadwal..."></textarea>
                    </div>

                    {{-- Tombol Ajukan --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11H9v4h2V7zm0 6H9v2h2v-2z"
                                    clip-rule="evenodd" />
                            </svg>
                            Ajukan Pergantian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
