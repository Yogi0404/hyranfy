<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin - HAYRANFY')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .sidebar-gradient {
      background: linear-gradient(180deg, #2D68C4 0%, #0F1C46 100%);
    }
    .menu-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      border-radius: 12px;
      font-weight: 500;
      transition: all 0.3s ease;
      background: linear-gradient(90deg, #3B6EC8 0%, #1D2C5E 100%);
    }
    .menu-item:hover {
      transform: scale(1.04);
      background: linear-gradient(90deg, #1D2C5E 0%, #3B6EC8 100%);
    }
    .menu-item.active {
      background: linear-gradient(90deg, #16244B 0%, #2C4DA8 100%);
      font-weight: 600;
    }
    .menu-icon {
      font-size: 1.3rem;
    }
  </style>
</head>

<body class="flex min-h-screen bg-gray-100">

  {{-- Sidebar --}}
  <aside class="w-64 sidebar-gradient text-white flex flex-col p-6">
    <h1 class="text-2xl font-bold mb-10 text-center tracking-wide">HAYRANFY</h1>

    <nav class="flex flex-col space-y-3">
      <a href="{{ route('admin.data-absensi') }}" 
         class="menu-item {{ request()->is('admin/data-absensi') ? 'active' : '' }}">
        <span class="menu-icon">📅</span>
        <span>Data Absensi</span>
      </a>

      <a href="{{ route('admin.pengajuan-cuti') }}" 
         class="menu-item {{ request()->is('admin/pengajuan-cuti') ? 'active' : '' }}">
        <span class="menu-icon">📝</span>
        <span>Pengajuan Cuti</span>
      </a>

      <a href="{{ route('admin.daftar-akun') }}" 
         class="menu-item {{ request()->is('admin/daftar-akun') ? 'active' : '' }}">
        <span class="menu-icon">👤</span>
        <span>Daftar Akun</span>
      </a>

      <a href="{{ route('admin.daftar-karyawan') }}" 
         class="menu-item {{ request()->is('admin/daftar-karyawan') ? 'active' : '' }}">
        <span class="menu-icon">👥</span>
        <span>Daftar Karyawan</span>
      </a>

      <a href="{{ route('admin.rekap-laporan') }}" 
         class="menu-item {{ request()->is('admin/rekap-laporan') ? 'active' : '' }}">
        <span class="menu-icon">📊</span>
        <span>Rekap Laporan</span>
      </a>
    </nav>

    <a href="{{ route('logout') }}" 
       class="mt-auto block text-center bg-red-600 hover:bg-red-700 py-2 rounded-full transition">
      🚪 Keluar
    </a>
  </aside>

  {{-- Konten halaman --}}
  <main class="flex-1 p-10">
    @yield('content')
  </main>

</body>
</html>
