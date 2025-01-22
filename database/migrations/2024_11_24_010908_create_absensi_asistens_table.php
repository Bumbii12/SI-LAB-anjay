<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi_asistens', function (Blueprint $table) {
            $table->id();
            $table->string('npm', 15);
            $table->date('tanggal');
            $table->string('id_kelas', 10);
            $table->string('keterangan', 255);
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('npm')->references('npm')->on('asistens')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_asistens');
    }
};
