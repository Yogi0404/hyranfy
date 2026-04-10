@extends('layouts.admin-layout')

@section('title', 'Daftar Karyawan - Hayranfy')

@section('content')
<h2 class="mb-6 text-2xl font-bold text-gray-800">👥 Daftar Karyawan</h2>

{{-- Bagian Atas: Search + Tambah --}}
<div class="flex items-center justify-between mb-6">
  <div class="relative w-1/3">
    <input type="text" id="searchKaryawan" placeholder="Cari Karyawan...." 
      class="w-full px-5 py-2 pr-10 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-400" />
    <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-2.5 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
    </svg>
  </div>

  <button onclick="openTambahModal()" 
    class="px-6 py-2 font-medium text-white bg-blue-700 rounded-full shadow-md hover:bg-blue-800">
    + Tambah Karyawan
  </button>
</div>

{{-- Grid Karyawan --}}
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
  @foreach($karyawans as $karyawan)
  <div class="p-5 text-center transition bg-gray-100 shadow-md rounded-2xl hover:shadow-lg">
    <img 
      src="{{ $karyawan->foto && file_exists(public_path($karyawan->foto)) ? asset($karyawan->foto) : asset('images/avatar.png') }}" 
      alt="Foto Karyawan" 
      class="object-cover w-24 h-24 mx-auto mb-4 rounded-full"
    >
    <h3 class="text-lg font-semibold text-gray-800">{{ $karyawan->nama }}</h3>
    <p class="text-sm text-gray-600">{{ $karyawan->jabatan }}</p>
    <button onclick="openDetailModal('{{ $karyawan->id }}', '{{ $karyawan->nama }}', '{{ $karyawan->nik }}', '{{ $karyawan->jabatan }}', '{{ $karyawan->alamat }}', '{{ $karyawan->jenis_kelamin }}', '{{ $karyawan->tanggal_lahir }}', '{{ $karyawan->agama }}', '{{ $karyawan->status_perkawinan }}')" 
      class="mt-4 bg-blue-900 hover:bg-blue-800 text-white px-5 py-1.5 rounded-full shadow">
      Lihat Detail
    </button>
  </div>
  @endforeach
</div>

{{-- Modal Tambah Karyawan --}}
<div id="modalTambahKaryawan" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
  <div class="bg-gray-100 rounded-2xl shadow-lg w-[900px] p-10 relative">
    <button onclick="closeTambahModal()" class="absolute text-2xl font-bold text-gray-600 top-4 right-4 hover:text-gray-800">&times;</button>
    <h3 class="mb-8 text-2xl font-bold text-center text-gray-800">Tambah Karyawan</h3>

    <form action="{{ route('admin.daftar-karyawan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <div class="grid grid-cols-2 gap-6">
        {{-- Kolom Kiri --}}
        <div class="space-y-3">
          <input type="text" name="nik" placeholder="NIK" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
          <input type="text" name="nama" placeholder="Nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
          <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
          <input type="date" name="tgl_lahir" placeholder="Tanggal Lahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
          <select name="jenis_kelamin" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
            <option disabled selected>Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
          <input type="text" name="alamat" placeholder="Alamat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
          <input type="text" name="agama" placeholder="Agama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
          <input type="text" name="status_perkawinan" placeholder="Status Perkawinan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
        </div>

        {{-- Kolom Kanan --}}
        <div class="space-y-3">
          <input type="text" name="jabatan" placeholder="Jabatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" required>
          <input type="number" step="0.01" name="gaji_pokok" placeholder="Gaji Pokok" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
          <input type="text" name="no_rekening" placeholder="No Rekening" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-600">Masukkan Foto</label>
            <input type="file" name="foto" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
          </div>
        </div>
      </div>

      <div class="flex justify-end gap-4 mt-6">
        <button type="button" onclick="closeTambahModal()" class="px-6 py-2 text-white bg-gray-400 rounded-full hover:bg-gray-500">Kembali</button>
        <button type="submit" class="px-6 py-2 text-white bg-blue-900 rounded-full hover:bg-blue-800">Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- Modal Detail Karyawan --}}
<div id="modalDetailKaryawan" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
  <div class="bg-white rounded-2xl shadow-lg w-[400px] p-8 relative">
    <button onclick="closeDetailModal()" class="absolute text-2xl font-bold text-gray-600 top-4 right-4 hover:text-gray-800">&times;</button>
    <h3 class="mb-4 text-xl font-semibold text-center text-gray-800">Detail Karyawan</h3>
    <div id="detailContent" class="space-y-2 text-sm text-gray-700">
      {{-- Data detail akan dimasukkan via JS --}}
    </div>
  </div>
</div>

<script>
  function openTambahModal() {
    document.getElementById('modalTambahKaryawan').classList.remove('hidden');
  }
  function closeTambahModal() {
    document.getElementById('modalTambahKaryawan').classList.add('hidden');
  }

  function openDetailModal(id, nama, nik, jabatan, alamat, jk, tglLahir, agama, status) {
    document.getElementById('modalDetailKaryawan').classList.remove('hidden');
    const content = `
      <p><strong>Nama:</strong> ${nama}</p>
      <p><strong>NIK:</strong> ${nik}</p>
      <p><strong>Jabatan:</strong> ${jabatan}</p>
      <p><strong>Alamat:</strong> ${alamat}</p>
      <p><strong>Jenis Kelamin:</strong> ${jk}</p>
      <p><strong>Tanggal Lahir:</strong> ${tglLahir}</p>
      <p><strong>Agama:</strong> ${agama}</p>
      <p><strong>Status Perkawinan:</strong> ${status}</p>
    `;
    document.getElementById('detailContent').innerHTML = content;
  }

  function closeDetailModal() {
    document.getElementById('modalDetailKaryawan').classList.add('hidden');
  }
</script>

@endsection
