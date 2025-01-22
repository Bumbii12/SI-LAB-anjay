<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswa extends Model
{
    protected $table = 'absensi_mahasiswas';
    protected $fillable = ['npm', 'id_kelas', 'tanggal', 'pertemuan', 'keterangan'];
}