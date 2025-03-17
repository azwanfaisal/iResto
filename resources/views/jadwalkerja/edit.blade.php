<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')<x-app-layout>
                            <x-slot name="header">
                                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                    {{ __('Edit Jadwal Kerja') }}
                                </h2>
                            </x-slot>
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                                        <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                                            <form method="POST" action="{{ route('jadwalkerja.update', $jadwalKerja->id) }}">
                                                @csrf
                                                @method('PUT')
                        
                                                <!-- Nama Karyawan -->
                                                <div>
                                                    <x-input-label for="karyawan_id" :value="__('Nama Karyawan')" />
                                                    <select id="karyawan_id" name="karyawan_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                                        @foreach ($karyawans as $karyawan)
                                                            <option value="{{ $karyawan->id }}" {{ $jadwalKerja->karyawan_id == $karyawan->id ? 'selected' : '' }}>
                                                                {{ $karyawan->nama_lengkap }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error :messages="$errors->get('karyawan_id')" class="mt-2" />
                                                </div>
                        
                                                <!-- Tanggal -->
                                                <div class="mt-4">
                                                    <x-input-label for="tanggal" :value="__('Tanggal')" />
                                                    <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" value="{{ $jadwalKerja->tanggal }}" required />
                                                    <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                                                </div>
                        
                                                <!-- Shift -->
                                                <div class="mt-4">
                                                    <x-input-label for="shift" :value="__('Shift')" />
                                                    <select id="shift" name="shift" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                                        <option value="pagi" {{ $jadwalKerja->shift == 'pagi' ? 'selected' : '' }}>Pagi</option>
                                                        <option value="siang" {{ $jadwalKerja->shift == 'siang' ? 'selected' : '' }}>Siang</option>
                                                        <option value="malam" {{ $jadwalKerja->shift == 'malam' ? 'selected' : '' }}>Malam</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('shift')" class="mt-2" />
                                                </div>
                        
                                                <div class="flex items-center justify-end mt-4">
                                                    <x-danger-link-button class="ms-4" :href="route('jadwalkerja.index')">
                                                        {{ __('Back') }}
                                                    </x-danger-link-button>
                                                    <x-primary-button class="ms-4">
                                                        {{ __('Update') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-app-layout>
                        
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="$user->name ?? old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="$user->email ?? old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Role Selection -->
                        <div class="mt-4">
                            <x-input-label for="roles" :value="__('Role')" />
                            <select id="roles" name="roles" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="admin" {{ $user->roles == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->roles == 'user' ? 'selected' : '' }}>User</option>
                                <option value="manajer" {{ $user->roles == 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('users.index')">
                                {{ __('Back') }}
                            </x-danger-link-button>
                            <x-primary-button class="ms-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>