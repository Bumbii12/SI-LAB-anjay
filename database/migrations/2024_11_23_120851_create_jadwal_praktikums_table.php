<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_praktikums', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->time('jam');
            $table->string('ruangan');
            $table->string('id_kelas', 10);
            $table->timestamps();
    
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_praktikums');
    }
};