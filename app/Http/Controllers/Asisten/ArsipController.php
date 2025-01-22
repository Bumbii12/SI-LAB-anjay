<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kelas;
use App\Models\ArsipPrak;

class ArsipController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $arsipPraks = ArsipPrak::all();

        return view('asisten.arsip.arsip', compact('kelas', 'arsipPraks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        ArsipPrak::create([
            'mata_proyek' => $request->mata_kuliah,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ]);

        return redirect()->route('asisten.arsip')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $arsip = ArsipPrak::findOrFail($id);
        $kelas = Kelas::all();
        return view('asisten.arsip.edit', compact('arsip', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        $arsip = ArsipPrak::findOrFail($id);
        $arsip->update([
            'mata_proyek' => $request->mata_kuliah,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ]);

        return redirect()->route('asisten.arsip')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $arsip = ArsipPrak::findOrFail($id);
        $arsip->delete();

        return redirect()->route('asisten.arsip')->with('success', 'Data berhasil dihapus.');
    }
}
