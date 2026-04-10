{{-- resources/views/karyawan/detail_gaji.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Gaji | Hayranfy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-white">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Detail Gaji</h1>
        <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Nama Karyawan' }}</p>
    </div>

    {{-- Konten Utama --}}
    <div class="flex-1 p-5">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Slip Gaji Bulan Oktober 2025</h2>

        {{-- Rincian Gaji --}}
        <div class="bg-gray-100 rounded-2xl shadow p-6 space-y-3">
            <div class="flex justify-between border-b border-gray-300 pb-2">
                <span class="text-gray-700">Gaji Pokok</span>
                <span class="font-semibold text-gray-900">Rp 4.000.000</span>
            </div>

            <div class="flex justify-between border-b border-gray-300 pb-2">
                <span class="text-gray-700">Tunjangan Kehadiran</span>
                <span class="font-semibold text-gray-900">Rp 500.000</span>
            </div>

            <div class="flex justify-between border-b border-gray-300 pb-2">
                <span class="text-gray-700">Lembur</span>
                <span class="font-semibold text-gray-900">Rp 250.000</span>
            </div>

            <div class="flex justify-between border-b border-gray-300 pb-2">
                <span class="text-gray-700">Potongan (Terlambat)</span>
                <span class="font-semibold text-red-600">‑ Rp 100.000</span>
            </div>

            <div class="flex justify-between pt-3 border-t border-gray-400">
                <span class="text-gray-900 font-semibold">Total Gaji Diterima</span>
                <span class="font-bold text-blue-900">Rp 4.650.000</span>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('karyawan.dashboard') }}"
               class="bg-blue-900 text-white px-6 py-2 rounded-full shadow hover:bg-blue-800 transition">
               Kembali ke Dashboard
            </a>
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
