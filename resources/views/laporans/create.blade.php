<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($laporan) ? __('Edit Laporan') : __('Buat Laporan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="py-6 px-8">
                    <form method="POST" action="{{ isset($laporan) ? route('laporans.update', $laporan) : route('laporans.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($laporan))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <x-input-label for="judul" :value="__('Judul Laporan')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" 
                                         :value="old('judul', $laporan->judul ?? '')" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <x-text-area id="deskripsi" class="block mt-1 w-full" name="deskripsi">
                                {{ old('deskripsi', $laporan->deskripsi ?? '') }}
                            </x-text-area>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="jenis_laporan" :value="__('Jenis Laporan')" />
                                <select id="jenis_laporan" name="jenis_laporan" required
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach(App\Models\Laporan::jenisOptions() as $value => $label)
                                        <option value="{{ $value }}" {{ old('jenis_laporan', $laporan->jenis_laporan ?? '') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('jenis_laporan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="format" :value="__('Format Laporan')" />
                                <select id="format" name="format" required
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach(App\Models\Laporan::formatOptions() as $value => $label)
                                        <option value="{{ $value }}" {{ old('format', $laporan->format ?? '') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('format')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="periode_awal" :value="__('Periode Awal')" />
                                <x-text-input id="periode_awal" class="block mt-1 w-full" type="date" name="periode_awal" 
                                             :value="old('periode_awal', isset($laporan) ? $laporan->periode_awal->format('Y-m-d') : '')" required />
                                <x-input-error :messages="$errors->get('periode_awal')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="periode_akhir" :value="__('Periode Akhir')" />
                                <x-text-input id="periode_akhir" class="block mt-1 w-full" type="date" name="periode_akhir" 
                                             :value="old('periode_akhir', isset($laporan) ? $laporan->periode_akhir->format('Y-m-d') : '')" required />
                                <x-input-error :messages="$errors->get('periode_akhir')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="file" :value="__('File Laporan (Opsional)')" />
                            <x-file-input id="file" class="block mt-1 w-full" name="file" />
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                            @if(isset($laporan) && $laporan->file_path)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                    File saat ini: {{ basename($laporan->file_path) }}
                                </p>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button :href="route('laporans.index')">
                                {{ __('Batal') }}
                            </x-danger-link-button>
                            <x-primary-button class="ml-4">
                                {{ isset($laporan) ? __('Update') : __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>