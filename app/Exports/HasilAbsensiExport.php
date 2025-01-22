<?php

namespace App\Exports;

use App\Models\AbsensiMahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class HasilAbsensiExport implements FromCollection
{
    public function collection()
    {
        return AbsensiMahasiswa::with(['mahasiswa', 'kelas'])->get()->map(function ($absensi) {
            return [
                'Nama Mahasiswa' => $absensi->mahasiswa->nama,
                'Kelas' => $absensi->kelas->nama_kelas,
                'Tanggal' => $absensi->tanggal,
                'Status' => $absensi->status,
            ];
        });
    }
}
