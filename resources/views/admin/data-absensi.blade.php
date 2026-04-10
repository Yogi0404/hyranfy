@extends('layouts.admin-layout')

@section('title', 'Data Absensi - Hairanfai')

@section('content')
<div class="flex flex-col gap-6">

    {{-- HEADER / TITLE TERPISAH --}}
<div class="bg-gradient-to-r from-blue-700 via-blue-800 to-blue-900 text-white rounded-2xl shadow-lg py-4 px-8 mb-4">
    <h2 class="text-3xl font-bold">📋 Data Absensi</h2>
</div>

{{-- CARD UNTUK TABEL --}}
<div class="bg-white shadow-md rounded-2xl overflow-hidden border border-gray-200">
    <table class="w-full text-left border-collapse">
        <thead class="bg-blue-900 text-white">
            <tr>
                <th class="p-4 text-sm font-semibold">ID Karyawan</th>
                <th class="p-4 text-sm font-semibold">Nama</th>
                <th class="p-4 text-sm font-semibold">Tanggal</th>
                <th class="p-4 text-sm font-semibold">Jam Masuk</th>
                <th class="p-4 text-sm font-semibold">Jam Pulang</th>
                <th class="p-4 text-sm font-semibold">Status</th>
                <th class="p-4 text-center text-sm font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensi as $absen)
                <tr class="even:bg-blue-50 odd:bg-gray-100 hover:bg-blue-100 transition duration-150">
                    <td class="p-4 font-medium text-gray-700">{{ $absen->karyawan->id_karyawan ?? '-' }}</td>
                    <td class="p-4 text-gray-700">{{ $absen->karyawan->nama ?? '-' }}</td>
                    <td class="p-4 text-gray-700">{{ \Carbon\Carbon::parse($absen->tanggal)->format('d/m/Y') }}</td>
                    <td class="p-4 text-gray-700">{{ $absen->jam_masuk ?? '-' }}</td>
                    <td class="p-4 text-gray-700">{{ $absen->jam_pulang ?? '-' }}</td>
                    <td class="p-4 text-gray-700 capitalize">{{ $absen->status ?? '-' }}</td>
                    <td class="p-4 text-center">
                        <a href="{{ route('admin.data-absensi.show', $absen->id) }}" 
                            class="bg-blue-900 hover:bg-blue-800 text-white px-5 py-1.5 rounded-full shadow-md transition-all duration-200">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">Belum ada data absensi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
