<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailGajiController extends Controller
{
    public function index()
    {
        // Nanti kamu bisa ganti logic-nya sesuai kebutuhan
        return view('karyawan.detail_gaji');
    }
}
