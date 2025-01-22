<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $keyType = 'string';
    protected $fillable = [
        'id_kelas', 
        'nama_kelas', 
        'mata_proyek', 
        'semester'
    ];
    public function asistens()
    {
        return $this->belongsToMany(Asisten::class, 'asisten_kelas', 'id_kelas', 'npm');
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'kelas_mahasiswa', 'id_kelas', 'npm');
    }

    public function jadwals()
    {
        return $this->hasMany(JadwalPraktikum::class, 'id_kelas', 'id_kelas');
    }
}
