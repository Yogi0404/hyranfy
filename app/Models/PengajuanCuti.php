<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_cutis'; // ganti sesuai nama tabelmu
    protected $fillable = [
        'karyawan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'keterangan',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
