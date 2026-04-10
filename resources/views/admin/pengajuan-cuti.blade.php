@extends('layouts.admin-layout')

@section('title', 'Pengajuan Cuti - Hairanfai')

@section('content')
<div class="space-y-10">
    
    {{-- HEADER --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-4">📝 Pengajuan Cuti</h2>

    {{-- ===================== TABEL PENGAJUAN CUTI ===================== --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-200">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-semibold text-blue-900">Daftar Pengajuan Cuti</h3>
        </div>

        <table class="w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="p-3 text-left w-28">ID_Karyawan</th>
                    <th class="p-3 text-left">Tanggal Pengajuan</th>
                    <th class="p-3 text-left">Tanggal Mulai</th>
                    <th class="p-3 text-left">Tanggal Selesai</th>
                    <th class="p-3 text-left">Jumlah Hari</th>
                    <th class="p-3 text-left">Keterangan</th>
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-center w-32">Konfirmasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuanCuti as $cuti)
                    <tr class="even:bg-gray-50 odd:bg-white hover:bg-blue-50 transition border-b">
                        <td class="p-3">{{ $cuti->karyawan->id_karyawan ?? '-' }}</td>
                        <td class="p-3">{{ $cuti->tanggal_pengajuan ?? '-' }}</td>
                        <td class="p-3">{{ $cuti->tanggal_mulai ?? '-' }}</td>
                        <td class="p-3">{{ $cuti->tanggal_selesai ?? '-' }}</td>
                        <td class="p-3">{{ $cuti->jumlah_hari ?? '-' }} Hari</td>
                        <td class="p-3">{{ $cuti->keterangan ?? '-' }}</td>
                        <td class="p-3">
                            @if($cuti->foto)
                                <img src="{{ asset('storage/' . $cuti->foto) }}" class="h-10 rounded-md border">
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="p-3 text-center">
                            <a href="{{ route('admin.pengajuan-cuti.show', $cuti->id) }}"
                               class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-1.5 rounded-full shadow-md transition text-sm">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-gray-500 p-4">Belum ada pengajuan cuti</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
