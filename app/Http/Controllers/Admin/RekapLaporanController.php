<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\Cuti;

class RekapLaporanController extends Controller
{
    public function index()
    {
        // =========================
        // Rekap Absen
        // =========================
        $rekapAbsen = Absensi::with('karyawan')
            ->orderBy('tanggal_absen', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->id_karyawan . '-' . $item->tanggal_absen;
            });

        // =========================
        // Rekap Cuti / Gaji (filter karyawan yang ada absensi atau cuti approved)
        // =========================
        $rekapCuti = Karyawan::whereHas('absensi')
            ->orWhereHas('cuti', function ($query) {
                $query->where('status', 'approved');
            })
            ->get()
            ->map(function ($k) {
                $totalHariKerja = 20;
                $totalHadir = Absensi::where('id_karyawan', $k->id)
                    ->where('tipe_absen', 'Masuk') // hitung hanya jam masuk
                    ->count();
                $totalCuti = Cuti::where('id_karyawan', $k->id)
                    ->where('status', 'approved')
                    ->count();

                $gajiPokok = $k->gaji ?? 0;
                $potongan = $totalCuti * ($gajiPokok / $totalHariKerja);
                $totalGaji = $gajiPokok - $potongan;

                return [
                    'nama' => $k->nama_lengkap,
                    'jabatan' => $k->jabatan ?? '-',
                    'hari_kerja' => $totalHariKerja,
                    'hadir' => $totalHadir,
                    'cuti' => $totalCuti,
                    'potongan' => $potongan,
                    'gaji_pokok' => $gajiPokok,
                    'total_gaji' => $totalGaji,
                ];
            });

        return view('admin.rekap-laporan', compact('rekapAbsen', 'rekapCuti'));
    }
}
