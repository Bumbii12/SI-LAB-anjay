<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use App\Models\Kelas;
use App\Models\NilaiMahasiswa;

class NilaiController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $nilaiMahasiswa = NilaiMahasiswa::all();

        return view('asisten.nilai.nilai', compact('kelas', 'nilaiMahasiswa'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'mata_kuliah' => 'required',
            'kelas' => 'required',
            'tanggal' => 'required',
            'file' => 'required|mimes:xls,xlsx|max:4096',
        ]);

        $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');

        $filePath = $request->file('file')->store('lampiran', 'public');

        $semester = in_array($request->semester, [1, 3, 5]) ? 'Ganjil' : 'Genap';

        NilaiMahasiswa::create([
            'semester' => $semester,
            'mata_kuliah' => $request->mata_kuliah,
            'kelas' => $request->kelas,
            'tanggal' => $tanggal, 
            'lampiran' => $filePath,
        ]);

        return redirect()->route('asisten.nilai')->with('success', 'File berhasil diunggah.');
    }

    public function edit($id)
    {
        $nilai = NilaiMahasiswa::findOrFail($id);
        $kelas = Kelas::all();

        return view('asisten.nilai.edit', compact('nilai', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'semester' => 'required',
            'mata_kuliah' => 'required',
            'kelas' => 'required',
            'tanggal' => 'required',
        ]);

        $nilai = NilaiMahasiswa::findOrFail($id);

        $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');
        $filePath = $nilai->lampiran;

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:xls,xlsx|max:4096',
            ]);

            // Hapus file lama
            Storage::disk('public')->delete($filePath);

            // Simpan file baru
            $filePath = $request->file('file')->store('lampiran', 'public');
        }

        $semester = in_array($request->semester, [1, 3, 5]) ? 'Ganjil' : 'Genap';

        $nilai->update([
            'semester' => $semester,
            'mata_kuliah' => $request->mata_kuliah,
            'kelas' => $request->kelas,
            'tanggal' => $tanggal,
            'lampiran' => $filePath,
        ]);

        return redirect()->route('asisten.nilai')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nilai = NilaiMahasiswa::findOrFail($id);

        // Hapus file lampiran
        Storage::disk('public')->delete($nilai->lampiran);

        $nilai->delete();

        return redirect()->route('asisten.nilai')->with('success', 'Data berhasil dihapus.');
    }
}
