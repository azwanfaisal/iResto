<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📝 Pengajuan Izin/Sakit/Cuti</h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('absensi.pengajuanIzinCuti') }}">
            @csrf

            <div class="mb-4">
                <label for="tanggal" class="block font-medium text-sm text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" required
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            </div>

            <div class="mb-4">
                <label for="status" class="block font-medium text-sm text-gray-700">Jenis Pengajuan</label>
                <select name="status" id="status" required
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    <option value="">-- Pilih --</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="cuti">Cuti</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="keterangan" class="block font-medium text-sm text-gray-700">Keterangan (opsional)</label>
                <textarea name="keterangan" id="keterangan" rows="3"
                          class="mt-1 block w-full rounded border-gray-300 shadow-sm"></textarea>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                ✅ Ajukan
            </button>
        </form>
    </div>
</x-app-layout>
