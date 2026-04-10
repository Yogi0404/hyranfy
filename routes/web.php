<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DaftarAkunController;
use App\Http\Controllers\Admin\DaftarKaryawanController;
use App\Http\Controllers\Admin\DataAbsensiController;
use App\Http\Controllers\Admin\PengajuanCutiController;
use App\Http\Controllers\Admin\RekapLaporanController;

// Karyawan Controllers
use App\Http\Controllers\Karyawan\DashboardController;
use App\Http\Controllers\Karyawan\TugasController;
use App\Http\Controllers\Karyawan\ProfilController;
use App\Http\Controllers\Karyawan\AbsenController;
use App\Http\Controllers\Karyawan\RiwayatPengajuanController;
use App\Http\Controllers\Karyawan\DetailGajiController;
use App\Http\Controllers\Karyawan\AbsensiController;
use App\Http\Controllers\Karyawan\FaceIDController;
use App\Http\Controllers\Karyawan\KaryawanController;



// ======================
// 🚀 REDIRECT UTAMA
// ======================
Route::get('/', fn() => redirect()->route('login'));

// ======================
// 🔑 LOGIN & LOGOUT
// ======================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ======================
// 🔓 LUPA PASSWORD
// ======================
Route::get('/lupa-password', [AuthController::class, 'showLupaPassword'])->name('lupa_password');
Route::post('/lupa-password', [AuthController::class, 'resetPassword'])->name('password.reset.post');

// ======================
// 🔒 ROUTE YANG HARUS LOGIN
// ======================
Route::middleware(['auth'])->group(function () {

    // ======================
    // 📂 ADMIN
    // ======================
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Daftar Akun
        Route::get('/daftar-akun', [DaftarAkunController::class, 'index'])->name('daftar-akun');
        Route::post('/daftar-akun', [DaftarAkunController::class, 'store'])->name('daftar-akun.store');
        Route::put('/daftar-akun/{id}', [DaftarAkunController::class, 'update'])->name('daftar-akun.update');
        Route::delete('/daftar-akun/{id}', [DaftarAkunController::class, 'destroy'])->name('daftar-akun.destroy'); // ✅ DITAMBAHKAN

        // Daftar Karyawan
        Route::get('/daftar-karyawan', [DaftarKaryawanController::class, 'index'])->name('daftar-karyawan');
        Route::post('/daftar-karyawan/store', [DaftarKaryawanController::class, 'store'])->name('daftar-karyawan.store');
        Route::get('/karyawan/{id}', [DaftarKaryawanController::class, 'show'])->name('karyawan.show');

        // Data Absensi
        Route::get('/data-absensi', [DataAbsensiController::class, 'index'])->name('data-absensi');
        Route::get('/data-absensi/{id}', [DataAbsensiController::class, 'show'])->name('data-absensi.show');

        // Pengajuan Cuti
        Route::get('/pengajuan-cuti', [PengajuanCutiController::class, 'index'])->name('pengajuan-cuti');
        Route::get('/pengajuan-cuti/{id}', [PengajuanCutiController::class, 'show'])->name('pengajuan-cuti.show');

        // Rekap Laporan
        Route::get('/rekap-laporan', [RekapLaporanController::class, 'index'])->name('rekap-laporan');
    });

    // ======================
    // 👨‍💼 KARYAWAN
    // ======================
    Route::prefix('karyawan')->name('karyawan.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Absen lama
        Route::get('/absen', [AbsensiController::class, 'index'])->name('absen.index');
Route::get('/absen/create', [AbsensiController::class, 'create'])->name('absen.create');
Route::post('/absen/store', [AbsensiController::class, 'store'])->name('absen.store');
Route::get('/absen/{id}', [AbsensiController::class, 'show'])->name('absen.show');
        // ✅ Absen baru via tombol "Kirim"
        Route::post('/absen-simpan', [AbsensiController::class, 'store'])->name('absen.store');

        // Tugas
       // Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');

        // Riwayat Pengajuan
        Route::get('/riwayat-pengajuan', [RiwayatPengajuanController::class, 'index'])->name('riwayat_pengajuan');

        // Detail Gaji
        Route::get('/detail-gaji', [DetailGajiController::class, 'index'])->name('detail_gaji');

       // Profil
Route::get('/profile', [ProfilController::class, 'index'])->name('profile');

// Edit & Update Profil
Route::get('/edit-profile', [KaryawanController::class, 'editProfile'])->name('edit_profile');
Route::post('/update-profile', [KaryawanController::class, 'updateProfile'])->name('update_profile');

Route::get('/face-descriptor', [FaceIDController::class, 'getDescriptor'])->name('face-descriptor');


    });
});
