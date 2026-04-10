<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Tampilkan halaman laporan karyawan
     */
    public function index()
    {
        // sementara cuma menampilkan view
        return view('karyawan.laporan');
    }
}
