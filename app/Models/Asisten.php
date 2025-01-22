<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asisten extends Model
{
    use HasFactory;
    protected $fillable = ['npm', 'nama'];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'asisten_kelas', 'asisten_id', 'id_kelas');
    }

    public function user() {
        return $this->belongsTo(User::class, 'npm', 'npm');
    }

    public function jadwals()
    {
        return $this->belongsToMany(JadwalPraktikum::class, 'jadwal_asistens', 'asisten_id', 'jadwal_id');
    }
    public function absensiAsisten()
{
    return $this->hasMany(AbsensiAsisten::class, 'npm', 'npm');
}

}
