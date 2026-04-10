<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hayranfy - Karyawan</title>

    {{-- Import Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font & Meta --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    
    {{-- Header --}}
    <header class="bg-gradient-to-r from-blue-900 to-blue-700 text-white p-4 flex justify-between items-center shadow">
        <h1 class="text-2xl font-bold">Hayranfy</h1>
        <p class="text-sm font-medium">
            {{ Auth::user()->name ?? 'Nama Karyawan' }}
        </p>
    </header>

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Bottom Navigation --}}
    <footer class="bg-gradient-to-r from-blue-900 to-blue-700 text-white flex justify-around py-2 rounded-t-2xl">
        {{-- Menu Absen --}}
        <a href="{{ route('karyawan.dashboard') }}" class="flex flex-col items-center text-blue-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
            </svg>
            <span class="text-xs">Absen</span>
        </a>

        {{-- Menu Laporan --}}
        <a href="{{ route('karyawan.laporan') }}" class="flex flex-col items-center text-gray-400 hover:text-blue-300 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v4a2 2 0 002 2z" />
            </svg>
            <span class="text-xs">Laporan</span>
        </a>

        {{-- Menu Tugas --}}
        <a href="{{ route('karyawan.tugas') }}" class="flex flex-col items-center text-gray-400 hover:text-blue-300 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 6.197M15 11v6m0 0h6m-6 0H9" />
            </svg>
            <span class="text-xs">Tugas</span>
        </a>

        {{-- Menu Profil --}}
        <a href="{{ route('karyawan.profile') }}" class="flex flex-col items-center text-gray-400 hover:text-blue-300 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 6.197M15 11v6m0 0h6m-6 0H9" />
            </svg>
            <span class="text-xs">Profil</span>
        </a>
    </footer>

</body>
</html>
