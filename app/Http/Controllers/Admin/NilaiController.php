<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\NilaiMahasiswa;

class NilaiController extends Controller
{
    public function index()
    {
        $nilaiMahasiswa = NilaiMahasiswa::all();

        return view('admin.nilai.nilai', compact('nilaiMahasiswa'));
    }

    public function destroy($id)
    {
        $nilai = NilaiMahasiswa::findOrFail($id);

        // Hapus file lampiran
        Storage::disk('public')->delete($nilai->lampiran);

        $nilai->delete();

        return redirect()->route('admin.nilai')->with('success', 'Data berhasil dihapus.');
    }
}
