<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('mata_kuliah');
            $table->string('kelas');
            $table->date('tanggal');
            $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_mahasiswas');
    }
};