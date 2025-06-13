<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 leading-tight">📝 Input Gaji Karyawan</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto">
        <form action="{{ route('penggajians.store') }}" method="POST" class="bg-white shadow-md rounded p-6">
            @csrf

            {{-- Pilih Karyawan --}}
            <div class="mb-4">
                <label for="karyawanSelect" class="block font-semibold mb-1">Karyawan</label>
                <select name="karyawan_id" id="karyawanSelect" class="form-select w-full border rounded px-3 py-2">
                    <option disabled selected>-- Pilih Karyawan --</option>
                    @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan['id'] }}">
                            {{ $karyawan['nama_lengkap'] }} - {{ $karyawan['jabatan'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Inputan --}}
            <div class="grid grid-cols-2 gap-4">
                @foreach ([
                    ['name' => 'gaji_pokok', 'label' => 'Gaji Pokok'],
                    ['name' => 'tunjangan_transport', 'label' => 'Tunjangan Transport'],
                    ['name' => 'tunjangan_makan', 'label' => 'Tunjangan Makan'],
                    ['name' => 'tunjangan_lembur', 'label' => 'Tunjangan Lembur'],
                    ['name' => 'potongan', 'label' => 'Potongan'],
                    ['name' => 'tanggal_gajian', 'label' => 'Tanggal Gajian', 'type' => 'date'],
                ] as $field)
                    <div>
                        <label class="block font-semibold mb-1">{{ $field['label'] }}</label>
                        <input
                            type="{{ $field['type'] ?? 'number' }}"
                            name="{{ $field['name'] }}"
                            id="{{ $field['name'] }}"
                            class="w-full border rounded px-3 py-2"
                            value="{{ old($field['name']) }}"
                            required
                        >
                    </div>
                @endforeach
            </div>

            {{-- Status --}}
            <div class="mt-4">
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="diproses">Belum Dibayar</option>
                    <option value="dibayar">Dibayar</option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">💾 Simpan Gaji</button>
            </div>
        </form>
    </div>
</x-app-layout>

{{-- Script --}}
<script>
    document.getElementById('karyawanSelect').addEventListener('change', function () {
        const karyawanId = this.value;

        fetch(`/penggajians/get-gaji-data/${karyawanId}`)
            .then(response => response.json())
            .then(data => {
                document.querySelector('[name="gaji_pokok"]').value = data.gaji_pokok;
                document.querySelector('[name="tunjangan_transport"]').value = data.tunjangan_transport;
                document.querySelector('[name="tunjangan_makan"]').value = data.tunjangan_makan;
                document.querySelector('[name="tunjangan_lembur"]').value = data.tunjangan_lembur;
                document.querySelector('[name="potongan"]').value = data.potongan;
            });
    });

    // Trigger default load on first karyawan
    window.addEventListener('DOMContentLoaded', () => {
        const firstOption = document.getElementById('karyawanSelect');
        if (firstOption) firstOption.dispatchEvent(new Event('change'));
    });
</script>
