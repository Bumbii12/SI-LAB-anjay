<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('npm', 15);
            $table->string('id_kelas', 10);
            $table->date('tanggal');
            $table->string('pertemuan');
            $table->enum('keterangan', ['HADIR', 'SAKIT', 'IZIN', 'ALPA']);
            $table->timestamps();
        
            $table->foreign('npm')->references('npm')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_mahasiswas');
    }
};
