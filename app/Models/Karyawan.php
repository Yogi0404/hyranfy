<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'jabatan',
        'foto',
        'gaji',
    ];

    // ✅ Relasi: Karyawan punya satu User
    public function user()
    {
        return $this->hasOne(User::class, 'id_karyawan', 'id');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_karyawan', 'id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_karyawan', 'id');
    }
}
