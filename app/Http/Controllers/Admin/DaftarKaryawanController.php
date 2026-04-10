<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;

class DaftarKaryawanController extends Controller
{
    // Tampilkan semua karyawan
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('admin.daftar-karyawan', compact('karyawans'));
    }

    // Tambah atau update karyawan (updateOrCreate)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date', // <- ini diganti
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'no_rekening' => 'nullable|string|max:30',
            'jabatan' => 'required|string',
            'gaji_pokok' => 'nullable|numeric',
            'tanggal_masuk' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/karyawan'), $filename);
            $validated['foto'] = 'uploads/karyawan/' . $filename;
        }

        // Update atau create berdasarkan NIK
        Karyawan::updateOrCreate(
            ['nik' => $validated['nik']],
            $validated
        );

        // ⚠️ Redirect diperbaiki sesuai nama route yang ada
        return redirect()->route('admin.daftar-karyawan')
            ->with('success', 'Karyawan berhasil ditambahkan atau diperbarui!');
    }

    // Tampilkan form edit karyawan
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.edit-karyawan', compact('karyawan'));
    }

    // Update karyawan
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|numeric|unique:karyawans,nik,' . $karyawan->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'pekerjaan' => 'nullable|string',
            'kewarganegaraan' => 'nullable|string',
            'jabatan' => 'required|string',
            'no_rekening' => 'nullable|string|max:30',
            'gaji_pokok' => 'nullable|numeric',
            'tanggal_masuk' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/karyawan'), $filename);
            $validated['foto'] = 'uploads/karyawan/' . $filename;
        }

        $karyawan->update($validated);

        return redirect()->route('admin.daftar-karyawan')
            ->with('success', 'Data karyawan berhasil diperbarui!');
    }

    // Hapus karyawan
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        if ($karyawan->foto && file_exists(public_path($karyawan->foto))) {
            unlink(public_path($karyawan->foto));
        }
        $karyawan->delete();

        return redirect()->route('admin.daftar-karyawan')
            ->with('success', 'Karyawan berhasil dihapus!');
    }

    // Tampilkan detail karyawan
    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.show-karyawan', compact('karyawan'));
    }
}
