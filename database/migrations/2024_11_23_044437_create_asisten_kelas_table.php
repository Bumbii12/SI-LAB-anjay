<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asisten_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asisten_id')->constrained('asistens')->onDelete('cascade');
            $table->string('id_kelas', 10);
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asisten_kelas');
    }
};
