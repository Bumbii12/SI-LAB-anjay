<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithHeadings
{
    /**
     * Mendapatkan semua data mahasiswa
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
{
    return Mahasiswa::with('kelas')->get()->map(function ($mahasiswa) {
        return [
            'npm' => $mahasiswa->npm,
            'nama' => $mahasiswa->nama,
            'no_hp' => $mahasiswa->no_hp,
            'kelas' => $mahasiswa->kelas->pluck('nama_kelas')->implode(', ') ?? null, // Perbaikan di sini
        ];
    });
}


    /**
     * Menentukan judul kolom di file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'NPM',
            'Nama',
            'No HP',
            'Kelas',
        ];
    }
}

