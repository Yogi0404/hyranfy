<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id('id_karyawan'); // Sesuai dengan SQL asli
            $table->string('nik', 20)->unique();
            $table->string('nama', 100);
            $table->string('tempat_lahir', 50);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('agama', 20)->nullable();
            $table->string('status_perkawinan', 20)->nullable();
            $table->string('no_rekening', 30)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->decimal('gaji_pokok', 10, 2)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('foto', 255)->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
