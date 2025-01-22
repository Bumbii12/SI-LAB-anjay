<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswas';
    protected $primaryKey = 'npm';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'npm', 
        'nama', 
        'id_kelas', 
        'no_hp'
    ];
    
    public function user()
    {
        return $this->hasOne(User::class, 'npm', 'npm');
    }
    
    public function asistens()
    {
        return $this->hasMany(Asisten::class, 'npm', 'npm');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mahasiswa', 'npm', 'id_kelas');
    }
}