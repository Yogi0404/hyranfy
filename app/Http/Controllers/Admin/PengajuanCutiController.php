<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    /**
     * Tampilkan daftar semua pengajuan cuti.
     */
    public function index()
    {
        // Ambil data cuti beserta relasi ke karyawan (jika ada)
        $pengajuanCuti = Cuti::with('karyawan')->latest()->get();

        return view('admin.pengajuan-cuti', compact('pengajuanCuti'));
    }

    /**
     * Tampilkan detail pengajuan cuti tertentu.
     */
    public function show($id)
    {
        $cuti = Cuti::with('karyawan')->findOrFail($id);

        return view('admin.detail-pengajuan-cuti', compact('cuti'));
    }

    /**
     * Konfirmasi atau tolak pengajuan cuti.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $cuti = Cuti::findOrFail($id);
        $cuti->status = $request->status;
        $cuti->save();

        return redirect()->route('admin.pengajuan-cuti')
                         ->with('success', 'Status pengajuan cuti berhasil diperbarui.');
    }
}
