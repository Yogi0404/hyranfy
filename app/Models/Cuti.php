<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cutis'; // sesuaikan dengan tabel DB kamu

    protected $fillable = [
        'id_karyawan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status', // approved / pending / rejected
        'keterangan',
    ];

    // Relasi ke Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
    }
}
