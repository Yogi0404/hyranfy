<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\Cuti;

class AdminController extends Controller
{
    // ==============================
    // DASHBOARD ADMIN
    // ==============================
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // ==============================
    // DAFTAR AKUN
    // ==============================
    public function daftarAkun()
    {
        $users = User::all(); // Ambil semua data user
        return view('admin.daftar-akun', compact('users'));
    }

    // ==============================
    // SIMPAN AKUN BARU
    // ==============================
    public function storeAkun(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.daftar-akun')->with('success', 'Akun baru berhasil ditambahkan!');
    }

    // ==============================
    // DAFTAR KARYAWAN
    // ==============================
    public function daftarKaryawan()
    {
        $karyawans = Karyawan::all();
        return view('admin.daftar-karyawan', compact('karyawans'));
    }

    // ==============================
    // SIMPAN DATA KARYAWAN BARU
    // ==============================
    public function storeKaryawan(Request $request)
{
    $validated = $request->validate([
        'nik' => 'required|unique:karyawans,nik',
        'nama_lengkap' => 'required|string|max:100',
        'tempat_lahir' => 'required|string|max:100',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|string',
        'alamat' => 'required|string',
        'agama' => 'required|string',
        'status_perkawinan' => 'required|string',
        'jabatan' => 'required|string',
        'gaji_pokok' => 'nullable|numeric',
        'no_rekening' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload foto jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/karyawan'), $filename);
        $validated['foto'] = 'images/karyawan/' . $filename;
    }

    // Simpan ke database
    \App\Models\Karyawan::create($validated);

    return redirect()->route('admin.daftar-karyawan')->with('success', 'Karyawan baru berhasil ditambahkan!');
}



    // ==============================
    // REKAP LAPORAN
    // ==============================
    public function rekapLaporan()
    {
        // Ambil data absensi join dengan karyawan
        $rekapAbsen = Absensi::with('karyawan')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Ambil data karyawan dengan relasi cuti & absensi untuk rekap
        $rekapCuti = Karyawan::with(['cuti', 'absensi'])->get()->map(function ($k) {
            $hari_kerja = 20; // contoh jumlah hari kerja per bulan
            $hadir = $k->absensi->count();
            $cuti = $k->cuti->where('status', 'disetujui')->count();
            $potongan = $cuti * 100000; // potongan Rp100.000 per cuti
            $total_gaji = ($k->gaji_pokok ?? 0) - $potongan;

            return [
                'nama' => $k->nama,
                'jabatan' => $k->jabatan,
                'hari_kerja' => $hari_kerja,
                'hadir' => $hadir,
                'cuti' => $cuti,
                'potongan' => $potongan,
                'gaji_pokok' => $k->gaji_pokok ?? 0,
                'total_gaji' => $total_gaji,
            ];
        });

        return view('admin.rekap-laporan', compact('rekapAbsen', 'rekapCuti'));
    }
    public function pengajuanCuti()
{
    $pengajuanCuti = \App\Models\Cuti::with('karyawan')->get();
    return view('admin.pengajuan-cuti', compact('pengajuanCuti'));
}
// ==============================
// DATA ABSENSI
// ==============================
public function dataAbsensi()
{
    // Ambil data absensi beserta relasi karyawan (jika ada)
    $absensis = \App\Models\Absensi::with('karyawan')->orderBy('tanggal', 'desc')->get();

    return view('admin.data-absensi', compact('absensis'));
}
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.daftar-akun')->with('success', 'Akun berhasil dihapus.');
}


}
