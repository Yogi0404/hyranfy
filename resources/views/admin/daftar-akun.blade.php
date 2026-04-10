@extends('layouts.admin-layout')

@section('title', 'Daftar Akun - Hairanfai')

@section('content')
<div class="flex flex-col gap-6">

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-800">👤 Daftar Akun</h2>
        <button onclick="openTambahModal()" 
            class="bg-gradient-to-r from-blue-700 to-blue-900 hover:opacity-90 text-white px-6 py-2 rounded-full shadow-md font-semibold transition-all duration-200">
            + Tambah Akun
        </button>
    </div>

    {{-- Tabel Akun --}}
    <div class="bg-white shadow-md rounded-2xl overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gradient-to-r from-blue-700 to-blue-900 text-white">
                <tr>
                    <th class="p-4 text-sm font-semibold">ID Karyawan</th>
                    <th class="p-4 text-sm font-semibold">Nama</th>
                    <th class="p-4 text-sm font-semibold">Email</th>
                    <th class="p-4 text-sm font-semibold">Password</th>
                    <th class="p-4 text-sm font-semibold">Role</th>
                    <th class="p-4 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="even:bg-blue-50 odd:bg-gray-100 hover:bg-blue-100 transition duration-150">
                        <td class="p-4 font-medium text-gray-700">{{ $user->id_karyawan }}</td>
                        <td class="p-4 text-gray-700">{{ $user->name }}</td>
                        <td class="p-4 text-gray-700">{{ $user->email ?? '—' }}</td>
                        <td class="p-4 text-gray-700">{{ $user->password_view ?? '—' }}</td>
                        <td class="p-4 capitalize text-gray-700">{{ $user->role }}</td>
                        <td class="p-4 text-center space-x-2">
                            {{-- Tombol Edit --}}
                            <button onclick="openEditModal('{{ $user->id }}', '{{ $user->id_karyawan }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" 
                                class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-1.5 rounded-full shadow-md transition-all duration-200">
                                Edit
                            </button>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.daftar-akun.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    onclick="return confirm('Yakin ingin menghapus akun {{ $user->name }}?')" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-full shadow-md transition-all duration-200">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Akun --}}
<div id="modalTambahAkun" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-[#F9FAFB] rounded-3xl shadow-xl w-[400px] p-8 relative animate-fadeIn">
    <button onclick="closeTambahModal()" 
        class="absolute top-4 right-5 text-gray-400 hover:text-gray-800 text-2xl font-bold">&times;</button>

    <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tambah Akun +</h3>

    <form action="{{ route('admin.daftar-akun.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="id_karyawan" placeholder="ID Karyawan"
            class="w-full rounded-full px-5 py-2.5 border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
        <input type="text" name="name" placeholder="Nama"
            class="w-full rounded-full px-5 py-2.5 border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
        <input type="email" name="email" placeholder="Email (opsional)"
            class="w-full rounded-full px-5 py-2.5 border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
        <input type="password" name="password" placeholder="Password"
            class="w-full rounded-full px-5 py-2.5 border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">

        <select name="role" class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-white text-gray-700 focus:ring-2 focus:ring-blue-600">
            <option value="" disabled selected>Role</option>
            <option value="Admin">Admin</option>
            <option value="Karyawan">Karyawan</option>
        </select>

        <button type="submit"
            class="w-full bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2 rounded-full shadow-md hover:opacity-90 transition-all duration-200">
            Simpan
        </button>
    </form>
  </div>
</div>

{{-- Modal Edit Akun --}}
<div id="modalEditAkun" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-[#F9FAFB] rounded-3xl shadow-xl w-[400px] p-8 relative animate-fadeIn">
    <button onclick="closeEditModal()" 
        class="absolute top-4 right-5 text-gray-400 hover:text-gray-800 text-2xl font-bold">&times;</button>

    <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Akun</h3>

    <form id="formEditAkun" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <input type="text" id="edit_id_karyawan" name="id_karyawan" placeholder="ID Karyawan"
            class="w-full rounded-full px-5 py-2.5 border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
        <input type="text" id="edit_name" name="name" placeholder="Nama"
            class="w-full rounded-full px-5 py-2.5 border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
        <input type="email" id="edit_email" name="email" placeholder="Email (opsional)"
            class="w-full rounded-full px-5 py-2.5 border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">
        <input type="password" id="edit_password" name="password" placeholder="Password (opsional)"
            class="w-full rounded-full px-5 py-2.5 border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:outline-none">

        <select id="edit_role" name="role"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-white text-gray-700 focus:ring-2 focus:ring-blue-600">
            <option value="Admin">Admin</option>
            <option value="Karyawan">Karyawan</option>
        </select>

        <button type="submit"
            class="w-full bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2 rounded-full shadow-md hover:opacity-90 transition-all duration-200">
            Simpan
        </button>
    </form>
  </div>
</div>

{{-- Script Modal --}}
<script>
    function openTambahModal() {
        document.getElementById('modalTambahAkun').classList.remove('hidden');
        document.getElementById('modalTambahAkun').classList.add('flex');
    }

    function closeTambahModal() {
        document.getElementById('modalTambahAkun').classList.add('hidden');
    }

    function openEditModal(id, id_karyawan, name, email, role) {
        const form = document.getElementById('formEditAkun');
        form.action = `/admin/daftar-akun/${id}`;
        document.getElementById('edit_id_karyawan').value = id_karyawan;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_role').value = role;
        const modal = document.getElementById('modalEditAkun');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('modalEditAkun').classList.add('hidden');
    }
</script>

{{-- Animasi --}}
<style>
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}
.animate-fadeIn {
  animation: fadeIn 0.25s ease-out;
}
</style>
@endsection
