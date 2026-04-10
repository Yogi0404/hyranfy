<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatPengajuanController extends Controller
{
    public function index()
    {
        // Halaman Riwayat Pengajuan Karyawan
        return view('karyawan.riwayat_pengajuan');
    }
}
