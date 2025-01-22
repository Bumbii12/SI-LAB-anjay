<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'kelas';

    // Primary key
    protected $primaryKey = 'id_kelas';

    // Key type
    protected $keyType = 'string';

    // Fillable fields
    protected $fillable = [
        'id_kelas', 
        'nama_kelas', 
        'mata_proyek', 
        'semester'
    ];

    /**
     * Relationship with Asisten (many-to-many via asisten_kelas table).
     */
    public function asistens()
    {
        return $this->belongsToMany(
            Asisten::class,     // Related model
            'asisten_kelas',    // Pivot table
            'id_kelas',         // Foreign key on the pivot table for this model
            'asisten_id',       // Foreign key on the pivot table for the related model
            'id_kelas',         // Local key on this model
            'id'                // Local key on the related model
        );
    }

    /**
     * Relationship with Mahasiswa (many-to-many via kelas_mahasiswa table).
     */
    public function mahasiswas()
    {
        return $this->belongsToMany(
            Mahasiswa::class,   // Related model
            'kelas_mahasiswa',  // Pivot table
            'id_kelas',         // Foreign key on the pivot table for this model
            'npm',              // Foreign key on the pivot table for the related model
            'id_kelas',         // Local key on this model
            'npm'               // Local key on the related model
        );
    }

    /**
     * Relationship with JadwalPraktikum (one-to-many).
     */
    public function jadwals()
    {
        return $this->hasMany(
            JadwalPraktikum::class, // Related model
            'id_kelas',             // Foreign key on the related model
            'id_kelas'              // Local key on this model
        );
    }
}
