<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mahasiswa;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeding Users
        User::create([
            'npm' => 'G1A022008',
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'), // Secure password
            'role' => 'admin',
            'photo' => '',
            'no_hp' => '081234567890',
        ]);

        User::create([
            'npm' => 'G1A022042',
            'name' => 'Asisten1',
            'email' => 'asisten1@example.com',
            'password' => bcrypt('asisten1'),
            'role' => 'asisten',
            'photo' => '',
            'no_hp' => '081298765432',
        ]);

        User::create([
            'npm' => 'G1A022005',
            'name' => 'Asisten2',
            'email' => 'asisten2@example.com',
            'password' => bcrypt('asisten2'),
            'role' => 'asisten',
            'photo' => '',
            'no_hp' => '081211223344',
        ]);

        // Seeding Kelas
        Kelas::create([
            'id_kelas' => 'KLS001',
            'nama_kelas' => 'Praktikum Sistem Multimedia',
            'mata_proyek' => 'Multimedia Development',
            'semester' => 'Ganjil',
        ]);

        Kelas::create([
            'id_kelas' => 'KLS002',
            'nama_kelas' => 'Praktikum Rekayasa Perangkat Lunak',
            'mata_proyek' => 'Software Engineering',
            'semester' => 'Genap',
        ]);

        Kelas::create([
            'id_kelas' => 'KLS003',
            'nama_kelas' => 'Praktikum Basis Data',
            'mata_proyek' => 'Database Management',
            'semester' => 'Ganjil',
        ]);

        // Seeding Mahasiswas
        Mahasiswa::create([
            'npm' => '200001001',
            'nama' => 'Mahasiswa 1',
            'no_hp' => '081345678901',
        ]);

        Mahasiswa::create([
            'npm' => '200001002',
            'nama' => 'Mahasiswa 2',
            'no_hp' => '081345678902',
        ]);

        Mahasiswa::create([
            'npm' => '200001003',
            'nama' => 'Mahasiswa 3',
            'no_hp' => '081345678903',
        ]);
    }
}