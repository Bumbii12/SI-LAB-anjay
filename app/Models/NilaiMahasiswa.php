<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'nilai_mahasiswas';
    protected $fillable = [
        'semester', 
        'mata_kuliah', 
        'kelas', 
        'tanggal', 
        'lampiran'
    ];
}