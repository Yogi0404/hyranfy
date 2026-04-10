<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id_karyawan',
        'name',
        'email',
        'password',
        'password_view',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ✅ Relasi: User milik satu Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function isAdmin()
    {
        return strtolower($this->role) === 'admin';
    }

    public function isKaryawan()
    {
        return strtolower($this->role) === 'karyawan';
    }
}
