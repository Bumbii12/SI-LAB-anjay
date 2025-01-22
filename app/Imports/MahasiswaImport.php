<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    /**
     * Convert each row to a Mahasiswa model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Mahasiswa([
            'npm' => $row['npm'], // Sesuaikan dengan kolom Excel
            'nama' => $row['nama'],
            'no_hp' => $row['no_hp'],
        ]);
    }
}
