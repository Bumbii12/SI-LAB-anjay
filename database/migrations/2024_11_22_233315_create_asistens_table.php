<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistens', function (Blueprint $table) {
            $table->id();
            $table->string('npm');
            $table->string('nama');
            $table->string('photo')->nullable();
            $table->timestamps();
    
            $table->foreign('npm')->references('npm')->on('mahasiswas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistens');
    }
};
