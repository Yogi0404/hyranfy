<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    // Menampilkan profil karyawan yang login
    public function profile()
    {
        $karyawan = Karyawan::where('user_id', Auth::id())->first();

        if (!$karyawan) {
            return redirect()->route('karyawan.dashboard')->with('error', 'Data karyawan tidak ditemukan.');
        }

        return view('karyawan.profile', compact('karyawan'));
    }

    // Menampilkan form edit profil karyawan (otomatis dari user login)
    public function editProfile()
    {
        $karyawan = Karyawan::where('user_id', Auth::id())->firstOrFail();
        return view('karyawan.edit_profile', compact('karyawan'));
    }

    // Update data profil karyawan
    public function updateProfile(Request $request)
    {
        $karyawan = Karyawan::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $karyawan->foto = 'images/' . $filename;
        }

        // Update data (tanpa menimpa kolom foto lama jika tidak ada upload baru)
        $karyawan->update($request->except('foto'));
        $karyawan->save();

        return redirect()->route('karyawan.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
