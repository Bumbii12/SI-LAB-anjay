<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktikum extends Model
{
    use HasFactory;

    protected $fillable = ['hari', 'jam', 'ruangan', 'id_kelas'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function asistens()
    {
        return $this->belongsToMany(Asisten::class, 'jadwal_asistens', 'jadwal_id', 'asisten_id');
    }
}