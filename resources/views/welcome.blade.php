<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Sistem Manajemen Karyawan</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-500 to-purple-600 shadow-lg py-5">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-6">
            <!-- Logo / Judul -->
            <h1 class="text-3xl font-extrabold text-white tracking-wide">
                <span class="bg-white text-indigo-600 px-3 py-1 rounded-md">SMK</span> Manajemen
            </h1>

            <!-- Navigation -->
            <nav class="space-x-4">
                <a href="{{ route('login') }}"
                    class="px-6 py-2 text-black font-semibold rounded-lg shadow-md bg-white hover:bg-gray-700 transition duration-300">
                    Log in
                </a>
                <a href="{{ route('register') }}"
                    class="px-6 py-2 text-white font-semibold rounded-lg shadow-md bg-green-500 hover:bg-green-600 transition duration-300">
                    Register
                </a>
            </nav>
        </div>
    </header>


    <!-- Hero Section -->
    <section class="flex flex-col md:flex-row items-center max-w-7xl mx-auto py-16 px-6">
        <!-- Teks -->
        <div class="md:w-1/2 fade-in">
            <h2 class="text-5xl font-bold text-gray-900 dark:text-white leading-tight">
                Selamat Datang di <span class="text-indigo-600 dark:text-indigo-400">Sistem Manajemen Karyawan</span>
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                Kelola data karyawan, penggajian, dan absensi dengan mudah dan efisien.
            </p>
            <a href="{{ url('/dashboard') }}"
                class="mt-6 inline-block px-6 py-3 text-white bg-indigo-600 rounded-lg text-lg font-semibold shadow-md hover:bg-indigo-700 transition">
                Mulai Sekarang
            </a>
        </div>

        <!-- Gambar -->
        <div class="md:w-1/2 mt-8 md:mt-0 fade-in">
            <img src="<?= asset('storage/karyawan/welcome.png') ?>" alt="Hero Image">

        </div>
    </section>

    <!-- Fitur -->
    <section class="max-w-6xl mx-auto py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $features = [
                ['title' => 'Data Karyawan', 'desc' => 'Kelola data karyawan dengan mudah.', 'icon' => 'user-group'],
                ['title' => 'Penggajian', 'desc' => 'Kelola penggajian karyawan.', 'icon' => 'currency-dollar'],
                ['title' => 'Absensi', 'desc' => 'Pantau kehadiran karyawan.', 'icon' => 'clock'],
                ['title' => 'Laporan', 'desc' => 'Lihat laporan lengkap.', 'icon' => 'document-text'],
            ];
        @endphp
        @foreach ($features as $feature)
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-xl transition transform hover:-translate-y-2 flex flex-col items-center text-center">
                <svg class="w-16 h-16 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    @if ($feature['icon'] === 'user-group')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-6h-5M12 20h5v-10h-5M7 20h5V8H7M3 20h4V4H3v16z" />
                    @elseif ($feature['icon'] === 'currency-dollar')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c1.5-2 4.5-2 6 0M12 16c-1.5 2-4.5 2-6 0m6-8V4m0 16v-4" />
                    @elseif ($feature['icon'] === 'clock')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    @elseif ($feature['icon'] === 'document-text')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m-7 4h8m-5-16h-3a2 2 0 00-2 2v16a2 2 0 002 2h8a2 2 0 002-2V9l-5-5z" />
                    @endif
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mt-4">{{ $feature['title'] }}</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $feature['desc'] }}</p>
            </div>
        @endforeach
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-center py-6 mt-12">
        <p class="text-gray-400 text-sm">
            &copy; {{ date('Y') }} Sistem Manajemen Karyawan. All rights reserved.
        </p>
    </footer>

</body>

</html>
