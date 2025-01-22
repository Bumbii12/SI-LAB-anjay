<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Asisten; // Pastikan model Asisten ada
use App\Models\AbsensiAsisten; // Pastikan model AbsensiAsistens ada

class AbsensiAsistenController extends Controller
{
    public function create()
    {
        $kelas = Kelas::all();
        return view('asisten.absensi.asisten', compact('kelas'));
    }

    public function getAsistenByNpm(Request $request)
    {
        $request->validate([
            'npm' => 'required|exists:asistens,npm',
        ]);

        $asisten = Asisten::where('npm', $request->npm)->first();

        return response()->json(['nama' => $asisten ? $asisten->nama : null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kelas' => 'required|exists:kelas,id_kelas',
            'npm' => 'required|exists:asistens,npm',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('foto_asistens', 'public');
        }
    
        AbsensiAsisten::create([
            'tanggal' => $request->tanggal,
            'id_kelas' => $request->kelas,
            'npm' => $request->npm,
            'keterangan' => 'Present',
            'foto' => $pathFoto,
        ]);
    
        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }
}