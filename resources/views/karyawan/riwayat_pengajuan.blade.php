{{-- resources/views/karyawan/riwayat_pengajuan.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan | Hayranfy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-white">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Riwayat Pengajuan</h1>
        <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Aleena Aufa Rizkiana' }}</p>
    </div>

    {{-- Konten --}}
    <div class="flex-1 p-5">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Daftar Pengajuan</h2>

        {{-- List Riwayat Pengajuan --}}
        <div class="space-y-4">

            <div class="p-4 bg-gray-100 rounded-2xl shadow flex justify-between items-center">
                <div>
                    <p class="font-medium text-gray-800">Cuti Tahunan</p>
                    <p class="text-sm text-gray-500">Diajukan: 1 November 2025</p>
                </div>
                <span class="text-green-600 font-semibold">Disetujui</span>
            </div>

            <div class="p-4 bg-gray-100 rounded-2xl shadow flex justify-between items-center">
                <div>
                    <p class="font-medium text-gray-800">Izin Tidak Masuk</p>
                    <p class="text-sm text-gray-500">Diajukan: 30 Oktober 2025</p>
                </div>
                <span class="text-yellow-500 font-semibold">Menunggu</span>
            </div>

            <div class="p-4 bg-gray-100 rounded-2xl shadow flex justify-between items-center">
                <div>
                    <p class="font-medium text-gray-800">Lembur Akhir Pekan</p>
                    <p class="text-sm text-gray-500">Diajukan: 25 Oktober 2025</p>
                </div>
                <span class="text-red-600 font-semibold">Ditolak</span>
            </div>

        </div>
    </div>

  
<!-- Navigasi Bawah -->
<nav class="bg-gradient-to-r from-blue-900 to-blue-700 flex justify-around py-2 rounded-t-2xl shadow-inner fixed bottom-0 left-0 right-0">
    <a href="{{ route('karyawan.dashboard') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.dashboard') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
        </svg>
        <span class="text-xs">Absen</span>
    </a>
    <a href="{{ route('karyawan.detail_gaji') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.detail_gaji') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v4a2 2 0 002 2z" />
        </svg>
        <span class="text-xs">Gaji</span>
    </a>
    <a href="{{ route('karyawan.riwayat_pengajuan') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.riwayat_pengajuan') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-xs">Pengajuan</span>
    </a>
    <a href="{{ route('karyawan.profile') }}" class="flex flex-col items-center {{ request()->routeIs('karyawan.profil') ? 'text-blue-300' : 'text-gray-300 hover:text-blue-200 transition' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.866 0 7 1.79 7 4v2H5v-2c0-2.21 3.134-4 7-4zm0-10a4 4 0 110 8 4 4 0 010-8z" />
        </svg>
        <span class="text-xs">Profil</span>
    </a>
</nav>

    </div>

</body>
</html>
