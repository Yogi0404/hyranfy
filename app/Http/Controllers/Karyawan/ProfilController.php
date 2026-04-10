<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil data karyawan berdasarkan user_id
        $karyawan = Karyawan::where('id_karyawan', $user->id_karyawan)->first();

        return view('karyawan.profile', compact('karyawan'));
    }
}
