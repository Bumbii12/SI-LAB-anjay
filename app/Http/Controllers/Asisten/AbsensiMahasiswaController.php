<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\AbsensiMahasiswa;

class AbsensiMahasiswaController extends Controller
{
    public function index() 
    {
        $proyekGanjil = Kelas::where('semester', 'Ganjil')->get()->groupBy('mata_proyek');
        $proyekGenap = Kelas::where('semester', 'Genap')->get()->groupBy('mata_proyek');

        return view('asisten.absensi.mahasiswa', compact('proyekGanjil', 'proyekGenap'));
    }

    public function showAbsensi($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
 
        $mahasiswas = Mahasiswa::whereHas('kelas', function($query) use ($id_kelas) {
            $query->where('kelas.id_kelas', $id_kelas);
        })->get();
    
        return view('asisten.absensi.mahasiswaDetail', compact('kelas', 'mahasiswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'npm' => 'required|array|min:1',
            'pertemuan' => 'required',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'keterangan' => 'required|array',
            'keterangan.*' => 'required|in:HADIR,SAKIT,IZIN,ALPA',
        ]);

        $validNpms = Mahasiswa::whereHas('kelas', function($query) use ($request) {
            $query->where('kelas.id_kelas', $request->id_kelas);
        })->whereIn('npm', $request->npm)->pluck('npm')->toArray();
    
        if (count($validNpms) !== count($request->npm)) {
            return back()->withErrors(['npm' => 'Beberapa mahasiswa tidak terdaftar di kelas ini'])->withInput();
        }
    
        $absensis = [];
        foreach ($request->npm as $npm) {
            if (!isset($request->keterangan[$npm])) {
                return back()->withErrors(['keterangan' => "Mahasiswa dengan NPM {$npm} harus memiliki keterangan."])->withInput();
            }
    
            $absensis[] = [
                'npm' => $npm,
                'id_kelas' => $request->id_kelas,
                'tanggal' => $request->tanggal,
                'pertemuan' => $request->pertemuan,
                'keterangan' => $request->keterangan[$npm],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        AbsensiMahasiswa::insert($absensis);
    
        return redirect()->route('asisten.absensi.mahasiswa')->with('success', 'Absensi berhasil disimpan.');
    }

    public function konfirmasi(Request $request)
    {
        $kelas = Kelas::find($request->input('id_kelas'));

        $absensiData = [];

        foreach ($request->npm as $npm) {
            $absensiData[$npm] = [
                'npm' => $npm,
                'keterangan' => $request->keterangan[$npm],
            ];
        }

        $totalHadir = count(array_filter($absensiData, fn($data) => $data['keterangan'] === 'HADIR'));
        $totalSakit = count(array_filter($absensiData, fn($data) => $data['keterangan'] === 'SAKIT'));
        $totalIzin = count(array_filter($absensiData, fn($data) => $data['keterangan'] === 'IZIN'));
        $totalAlpa = count(array_filter($absensiData, fn($data) => $data['keterangan'] === 'ALPA'));

        return view('asisten.absensi.konfirmasi', compact('kelas', 'totalHadir', 'totalSakit', 'totalIzin', 'totalAlpa', 'absensiData'));
    }
}