<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DaftarAkunController extends Controller
{
    /**
     * Menampilkan daftar akun
     */
    public function index()
    {
        $users = User::all();
        return view('admin.daftar-akun', compact('users'));
    }

    /**
     * Simpan akun baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        User::create([
            'id_karyawan' => $request->id_karyawan,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'password_view' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.daftar-akun')->with('success', 'Akun berhasil ditambahkan!');
    }

    /**
     * Update akun
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'id_karyawan' => $request->id_karyawan,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if (!empty($request->password)) {
            $user->update([
                'password' => bcrypt($request->password),
                'password_view' => $request->password,
            ]);
        }

        return redirect()->route('admin.daftar-akun')->with('success', 'Akun berhasil diperbarui!');
    }

    /**
     * Hapus akun
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.daftar-akun')->with('success', 'Akun berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Gagal menghapus akun: ' . $e->getMessage());
            return redirect()->route('admin.daftar-akun')->with('error', 'Gagal menghapus akun.');
        }
    }
}
