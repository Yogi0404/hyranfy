<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Karyawan | Hayranfy</title>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

<!-- HEADER -->
<header class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center p-4 text-white bg-gradient-to-r from-blue-900 to-blue-600">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 mr-3">
    <h1 class="text-lg font-bold tracking-wide">Profil Karyawan</h1>
</header>

<main class="flex justify-center flex-1 px-4 pt-24 pb-20">
    <div class="w-full max-w-md p-6 bg-white shadow-lg rounded-2xl">

        <!-- Foto Profil -->
        <div class="flex justify-center mb-5">
            <img 
                src="{{ isset($karyawan) && $karyawan?->foto && file_exists(public_path($karyawan->foto)) 
                        ? asset($karyawan->foto) 
                        : asset('images/avatar.png') }}" 
                alt="Foto Karyawan" 
                class="object-cover border-4 border-blue-100 rounded-full shadow w-28 h-28"
            >
        </div>

        <!-- Info Karyawan -->
        <div class="space-y-3 text-sm text-gray-700">
            <div class="flex justify-between pb-1 border-b">
                <span class="font-medium">NIK</span>
                <span>{{ $karyawan->nik ?? '-' }}</span>
            </div>
            <div class="flex justify-between pb-1 border-b">
                <span class="font-medium">Nama Lengkap</span>
                <span>{{ $karyawan->nama ?? '-' }}</span>
            </div>
            <div class="flex justify-between pb-1 border-b">
                <span class="font-medium">Jabatan</span>
                <span>{{ $karyawan->jabatan ?? '-' }}</span>
            </div>
            <div class="flex justify-between pb-1 border-b">
                <span class="font-medium">Tempat, Tanggal Lahir</span>
                <span>{{ ($karyawan->tempat_lahir ?? '-') . ', ' . ($karyawan->tanggal_lahir ?? '-') }}</span>
            </div>
            <div class="flex justify-between pb-1 border-b">
                <span class="font-medium">Jenis Kelamin</span>
                <span>{{ $karyawan->jenis_kelamin ?? '-' }}</span>
            </div>
            <div class="flex justify-between pb-1 border-b">
                <span class="font-medium">Agama</span>
                <span>{{ $karyawan->agama ?? '-' }}</span>
            </div>
            <div class="flex justify-between pb-1 border-b">
                <span class="font-medium">Alamat</span>
                <span>{{ $karyawan->alamat ?? '-' }}</span>
            </div>
            <div class="flex justify-between pb-1 border-b">
                <span class="font-medium">Tanggal Bergabung</span>
                <span>{{ $karyawan->tanggal_masuk ?? '-' }}</span>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-center gap-4 mt-8">
            <a href="{{ route('karyawan.edit_profile') }}"
                class="px-6 py-2 text-sm font-medium text-white transition bg-blue-900 rounded-full shadow hover:bg-blue-800">
                <i class="mr-2 fa-solid fa-pen"></i> Edit Profil
            </a>
            <button onclick="window.print()"
                class="px-6 py-2 text-sm font-medium text-white transition bg-gray-700 rounded-full shadow hover:bg-gray-600">
                <i class="mr-2 fa-solid fa-print"></i> Cetak
            </button>
        </div>

    </div>
</main>

<!-- NAVBAR BAWAH -->
<nav class="fixed bottom-0 left-0 right-0 flex justify-around py-2 shadow-inner bg-gradient-to-r from-blue-900 to-blue-700 rounded-t-2xl">
    <a href="{{ route('karyawan.dashboard') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.dashboard') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
        </svg>
        <span class="text-xs">Absen</span>
    </a>

    <a href="{{ route('karyawan.detail_gaji') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.detail_gaji') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v4a2 2 0 002 2z" />
        </svg>
        <span class="text-xs">Gaji</span>
    </a>

    <a href="{{ route('karyawan.riwayat_pengajuan') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.riwayat_pengajuan') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-xs">Pengajuan</span>
    </a>

    <a href="{{ route('karyawan.profile') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.profile') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.866 0 7 1.79 7 4v2H5v-2c0-2.21 3.134-4 7-4zm0-10a4 4 0 110 8 4 4 0 010-8z" />
        </svg>
        <span class="text-xs">Profil</span>
    </a>
</nav>

</body>
</html>
