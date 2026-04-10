<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;  // Import helper Str
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah input adalah email atau username
        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $loginType => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek role tanpa case sensitive
            if (Str::lower($user->role) === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('karyawan.dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showLupaPassword()
    {
        return view('auth.lupa_password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('name', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan!');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login kembali.');
    }
}
