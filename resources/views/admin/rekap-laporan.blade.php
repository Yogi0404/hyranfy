@extends('layouts.admin-layout')

@section('title', 'Rekap Laporan')

@section('content')
<div class="space-y-10">

    {{-- REKAP ABSEN --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-blue-900 mb-4">Rekap Absen</h3>
        <table class="w-full border border-gray-200 rounded-lg text-sm">
            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="p-3 text-center">No</th>
                    <th class="p-3">Nama Karyawan</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Jam Masuk</th>
                    <th class="p-3">Jam Pulang</th>
                    <th class="p-3">Jabatan</th>
                    <th class="p-3">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse ($rekapAbsen as $group)
                    @php
                        $absenMasuk = $group->firstWhere('tipe_absen', 'Masuk');
                        $absenPulang = $group->firstWhere('tipe_absen', 'Pulang');
                        $karyawan = $absenMasuk->karyawan ?? $absenPulang->karyawan ?? null;
                    @endphp
                    <tr class="even:bg-gray-50 odd:bg-white border-b">
                        <td class="p-3 text-center">{{ $no++ }}</td>
                        <td class="p-3">{{ $karyawan->nama_lengkap ?? '-' }}</td>
                        <td class="p-3">{{ $absenMasuk->tanggal_absen ?? ($absenPulang->tanggal_absen ?? '-') }}</td>
                        <td class="p-3">{{ $absenMasuk->jam_absen ?? '-' }}</td>
                        <td class="p-3">{{ $absenPulang->jam_absen ?? '-' }}</td>
                        <td class="p-3">{{ $karyawan->jabatan ?? '-' }}</td>
                        <td class="p-3">{{ $absenMasuk->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 p-4">Belum ada data absensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- REKAP CUTI / GAJI --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-200 mt-10">
        <h3 class="text-lg font-semibold text-blue-900 mb-4">Rekap Izin / Cuti</h3>
        <table class="w-full border border-gray-200 rounded-lg text-sm">
            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="p-3 text-center">No</th>
                    <th class="p-3">Nama Karyawan</th>
                    <th class="p-3">Jabatan</th>
                    <th class="p-3 text-center">Hari Kerja</th>
                    <th class="p-3 text-center">Hadir</th>
                    <th class="p-3 text-center">Cuti</th>
                    <th class="p-3 text-center">Potongan</th>
                    <th class="p-3 text-center">Gaji Pokok</th>
                    <th class="p-3 text-center">Total Gaji</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rekapCuti as $index => $r)
                    <tr class="even:bg-gray-50 odd:bg-white border-b">
                        <td class="p-3 text-center">{{ $index + 1 }}</td>
                        <td class="p-3">{{ $r['nama'] }}</td>
                        <td class="p-3">{{ $r['jabatan'] ?? '-' }}</td>
                        <td class="p-3 text-center">{{ $r['hari_kerja'] }}</td>
                        <td class="p-3 text-center">{{ $r['hadir'] }}</td>
                        <td class="p-3 text-center">{{ $r['cuti'] }}</td>
                        <td class="p-3 text-center">Rp {{ number_format($r['potongan'], 0, ',', '.') }}</td>
                        <td class="p-3 text-center">Rp {{ number_format($r['gaji_pokok'], 0, ',', '.') }}</td>
                        <td class="p-3 text-center font-semibold text-green-600">Rp {{ number_format($r['total_gaji'], 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-gray-500 p-4">Belum ada data rekap gaji</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
