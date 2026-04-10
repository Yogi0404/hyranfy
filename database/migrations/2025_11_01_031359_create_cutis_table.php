<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan')->nullable();
            $table->date('tanggal_pengajuan')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('jumlah_hari')->default(0);
            $table->string('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->default('Menunggu');
            $table->timestamps();

            $table->foreign('id_karyawan')
                ->references('id_karyawan')
                ->on('karyawans')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cutis');
    }
};
