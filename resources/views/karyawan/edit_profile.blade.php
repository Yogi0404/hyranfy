@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
    }

    .edit-card {
        background: #f2f2f2;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        max-width: 400px;
        margin: 40px auto;
        padding: 30px 25px;
        text-align: center;
    }

    .edit-card img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-bottom: 20px;
        background-color: #ccc;
        object-fit: cover;
    }

    .edit-card h4 {
        margin-bottom: 20px;
        font-weight: 600;
    }

    .edit-card .form-control {
        border: none;
        border-radius: 10px;
        padding: 10px 15px;
        margin-bottom: 12px;
        background-color: #eaeaea;
        font-size: 14px;
    }

    .edit-card .form-control:focus {
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    .edit-card .btn {
        border-radius: 8px;
        font-weight: 500;
        width: 100px;
    }

    .edit-card .btn-dark {
        background-color: #001f3f;
        border: none;
    }

    .edit-card .btn-secondary {
        background-color: #4a5568;
        border: none;
    }

    .btn-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 10px;
    }
</style>

<div class="edit-card">
    <h4>Edit Profile</h4>
    <img src="{{ asset('images/avatar.png') }}" alt="Avatar">

    <form action="{{ route('karyawan.update_profil', $employee->id_karyawan) }}" method="POST">
        @csrf

        <input type="text" class="form-control" name="id_karyawan" value="{{ $employee->id_karyawan }}" readonly>
        <input type="text" class="form-control" name="nama_lengkap" value="{{ $employee->nama_lengkap }}" placeholder="Nama Lengkap" required>
        <input type="text" class="form-control" name="jabatan" value="{{ $employee->jabatan }}" placeholder="Jabatan" required>
        <input type="text" class="form-control" name="departemen" value="{{ $employee->departemen }}" placeholder="Departemen" required>
        <input type="email" class="form-control" name="email" value="{{ $employee->email }}" placeholder="Email" required>
        <input type="text" class="form-control" name="no_telepon" value="{{ $employee->no_telepon }}" placeholder="No. Telepon" required>
        <input type="text" class="form-control" name="tanggal_bergabung" value="{{ $employee->tanggal_bergabung }}" readonly>
        <textarea class="form-control" name="alamat_kantor" rows="2" placeholder="Alamat Kantor" required>{{ $employee->alamat_kantor }}</textarea>

        <div class="btn-container">
            <button type="submit" class="btn btn-dark">Simpan</button>
            <a href="{{ route('karyawan.show', $employee->id_karyawan) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
