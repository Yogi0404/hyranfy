<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;

class FaceIDController extends Controller
{
    public function getDescriptor()
    {
        $karyawan = Karyawan::where('user_id', Auth::id())->first();

        if (!$karyawan || !$karyawan->face_descriptor) {
            return response()->json([
                'label' => Auth::user()->name ?? 'Unknown',
                'descriptors' => [[0]] // placeholder kosong
            ]);
        }

        // Decode data descriptor JSON ke array
        $descriptors = json_decode($karyawan->face_descriptor, true);

        return response()->json([
            'label' => $karyawan->nama_lengkap,
            'descriptors' => $descriptors
        ]);
    }
}

