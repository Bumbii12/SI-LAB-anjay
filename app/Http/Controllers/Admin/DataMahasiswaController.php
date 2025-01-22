<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Imports\MahasiswaImport;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;

class DataMahasiswaController extends Controller
{
    // Display all Mahasiswa data
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'default'); // Default sorting
        $query = Mahasiswa::with('kelas'); // Get Mahasiswa with their associated classes

        // Handle sorting
        if ($sort === 'npm_asc') {
            $query->orderBy('npm', 'asc');
        } elseif ($sort === 'npm_desc') {
            $query->orderBy('npm', 'desc');
        }

        $mahasiswa = $query->paginate(2); // Paginate the results
        $kelas = Kelas::all(); // Get all available classes


        return view('admin.data.mahasiswa', compact('mahasiswa', 'kelas'));
    }

    // Store a new Mahasiswa
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'npm' => 'required|unique:mahasiswas,npm|max:15',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'kelas_id' => 'required|array',
            'kelas_id.*' => 'exists:kelas,id_kelas'
        ]);

        try {
            $mahasiswa = Mahasiswa::create([
                'npm' => $validatedData['npm'],
                'nama' => $validatedData['nama'],
                'no_hp' => $validatedData['no_hp']
            ]);

            // Attach kelas to mahasiswa
            $mahasiswa->kelas()->attach($validatedData['kelas_id']);

            return redirect()->route('data.mahasiswas.index')->with('success', 'Mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan mahasiswa: ' . $e->getMessage());
        }
    }

    // Show the edit form for a Mahasiswa
    public function edit($id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
    $kelas = Kelas::all(); // Ambil data kelas yang tersedia
    return view('admin.data.edit_mahasiswa', compact('mahasiswa', 'kelas'));
}

public function update(Request $request, $id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->update($request->only('npm', 'nama', 'no_hp'));

    // Update kelas yang terkait
    $mahasiswa->kelas()->sync($request->kelas_id);

    return redirect()->route('data.mahasiswas.index')->with('success', 'Data mahasiswa berhasil diperbarui');
}

    // Delete a Mahasiswa
    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->kelas()->detach();  // Detach associated classes first
            $mahasiswa->delete();  // Then delete the mahasiswa

            return redirect()->route('data.mahasiswas.index')->with('success', 'Mahasiswa berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus mahasiswa: ' . $e->getMessage());
        }
    }



public function import(Request $request)
{
    // Validasi file upload
    $validatedData = $request->validate([
        'file' => 'required|file|mimes:xlsx,csv',
    ]);

    try {
        // Import file Excel
        Excel::import(new MahasiswaImport, $request->file('file'));

        return redirect()->route('data.mahasiswas.index')->with('success', 'Data mahasiswa berhasil diimpor');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
    }
}
public function export()
    {
        // Menentukan nama file export
        return Excel::download(new MahasiswaExport, 'data_mahasiswa.xlsx');
    }
}
