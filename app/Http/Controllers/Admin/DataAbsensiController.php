<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class DataAbsensiController extends Controller
{
    /**
     * Menampilkan semua data absensi (untuk admin).
     */
    public function index()
    {
        // Ambil semua absensi beserta data karyawan terkait
        $absensi = Absensi::with('karyawan')->latest()->get();

        return view('admin.data-absensi', compact('absensi'));
    }

    /**
     * Menampilkan detail absensi berdasarkan ID.
     */
    public function show($id)
    {
        $absen = Absensi::with('karyawan')->findOrFail($id);

        return view('admin.detail-absensi', compact('absen'));
    }

    /**
     * (Opsional) Konfirmasi atau ubah status absensi jika dibutuhkan.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,alpha,terlambat',
        ]);

        $absen = Absensi::findOrFail($id);
        $absen->status = $request->status;
        $absen->save();

        // ✅ route name diperbaiki agar sesuai
        return redirect()->route('admin.data-absensi')->with('success', 'Status absensi berhasil diperbarui.');
    }
}
