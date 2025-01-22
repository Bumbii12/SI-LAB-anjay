<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_asistens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('asisten_id');
            $table->timestamps();
    
            $table->foreign('jadwal_id')->references('id')->on('jadwal_praktikums')->onDelete('cascade');
            $table->foreign('asisten_id')->references('id')->on('asistens')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_asistens');
    }
};