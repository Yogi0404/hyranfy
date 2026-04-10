<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawans = [
            [
                'id_karyawan' => 1,
                'nik' => '1234567890',
                'nama' => 'Admin Satu',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Merdeka No.1',
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'no_rekening' => '123456789012345',
                'jabatan' => 'Admin',
                'gaji_pokok' => 8000000,
                'tanggal_masuk' => '2020-01-01',
                'foto' => 'images/avatar.svg',
                'face_descriptor' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_karyawan' => 2,
                'nik' => '0987654321',
                'nama' => 'Karyawan Satu',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '1992-05-15',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Sudirman No.2',
                'agama' => 'Kristen',
                'status_perkawinan' => 'Kawin',
                'no_rekening' => '987654321098765',
                'jabatan' => 'Staff IT',
                'gaji_pokok' => 5000000,
                'tanggal_masuk' => '2021-03-15',
                'foto' => 'images/avatar.svg',
                'face_descriptor' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('karyawans')->insert($karyawans);

        $users = [
            [
                'name' => 'Admin Satu',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'id_karyawan' => 1,
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karyawan Satu',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password123'),
                'id_karyawan' => 2,
                'role' => 'karyawan',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
