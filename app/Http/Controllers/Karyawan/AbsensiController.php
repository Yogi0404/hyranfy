<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    /**
     * Simpan data absen baru
     */
    public function store(Request $request)
    {
        try {
            $karyawan = Auth::user();

            $absen = Absensi::create([
                'karyawan_id' => $karyawan->id,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'jam_masuk' => Carbon::now()->format('H:i:s'),
                'status' => 'hadir',
            ]);

            return response()->json([
                'success' => true,
                'absen' => [
                    'id' => $absen->id,
                    'tanggal' => Carbon::parse($absen->tanggal)->format('d/m/Y'),
                    'jam_masuk' => $absen->jam_masuk
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal absen: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan absen: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail absen
     */
    public function show($id)
    {
        $absen = Absensi::findOrFail($id);
        return view('karyawan.absen-detail', compact('absen'));
    }
}
