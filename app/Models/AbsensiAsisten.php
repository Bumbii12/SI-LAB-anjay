<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsensiAsisten extends Model
{
    use HasFactory;

    protected $table = 'absensi_asistens'; // Menentukan nama tabel jika berbeda dari konvensi Laravel

    protected $fillable = [
        'npm', 
        'tanggal', 
        'id_kelas', 
        'keterangan',
        'foto'
    ];

    public function asisten()
    {
        return $this->belongsTo(Asisten::class, 'npm', 'npm');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
