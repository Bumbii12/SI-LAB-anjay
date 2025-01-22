<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktikum;
use App\Models\Kelas;
use App\Models\Asisten;
use Illuminate\Http\Request;

class JadwalPraktikumController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPraktikum::with(['kelas', 'asistens'])->paginate(1);
        $kelas = Kelas::all();
        $asistens = Asisten::all();

        return view('admin.jadwal-praktikum.index', compact('jadwals', 'kelas', 'asistens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam' => 'required',
            'ruangan' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'asdos_ids' => 'required|array|min:1', // pastikan ada setidaknya 1 asdos
            'asdos_ids.*' => 'exists:asistens,id', // validasi setiap ID asdos
        ]);
    
        // Membuat Jadwal Praktikum
        $jadwal = JadwalPraktikum::create($request->only(['hari', 'jam', 'ruangan', 'id_kelas']));
    
        // Menambahkan relasi dengan asisten dosen
        $jadwal->asistens()->attach($request->asdos_ids);
    
        return redirect()->route('jadwal-praktikum.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }
    
    
    public function edit($id)
    {
        $jadwal = JadwalPraktikum::with('asistens')->findOrFail($id);
        $kelas = Kelas::all();
        $asistens = Asisten::all();

        return view('admin.jadwal-praktikum.edit', compact('jadwal', 'kelas', 'asistens'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam' => 'required',
            'ruangan' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'asdos_ids' => 'required|array',
        ]);

        $jadwal = JadwalPraktikum::findOrFail($id);
        $jadwal->update($request->only(['hari', 'jam', 'ruangan', 'id_kelas']));
        $jadwal->asistens()->sync($request->asdos_ids);

        return redirect()->route('jadwal-praktikum.index')->with('success', 'Jadwal berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPraktikum::findOrFail($id);
        $jadwal->asistens()->detach();
        $jadwal->delete();

        return redirect()->route('jadwal-praktikum.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}