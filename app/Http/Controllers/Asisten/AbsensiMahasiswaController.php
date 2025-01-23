<?php
namespace App\Http\Controllers\Asisten;

use App\Models\Kelas;
use App\Models\AbsensiMahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class AbsensiMahasiswaController extends Controller
{
    public function index()
    {
        $asistenId = Auth::id();
        
        // Retrieve the classes managed by the assistant (based on the assistant's ID)
        $kelasList = Kelas::whereHas('asistens', function ($query) use ($asistenId) {
            $query->where('asistens.id', $asistenId); // Ensure the assistant is managing this class
        })->get();
      
        // Pass the classes list to the view
        return view('asisten.absensi.mahasiswa', compact('kelasList'));
    }

    public function showAbsensi($id_kelas)
    {
        $asistenId = Auth::id();

        // Retrieve the class based on id_kelas and ensure it's managed by the logged-in assistant
        $kelas = Kelas::where('id_kelas', $id_kelas)
            ->whereHas('asistens', function ($query) use ($asistenId) {
                $query->where('asistens.id', $asistenId);
            })
            ->firstOrFail();

        // Fetch students enrolled in this class
        $mahasiswas = $kelas->mahasiswas;

        // Fetch absensi data for the class and group by pertemuan (session)
        $absensis = AbsensiMahasiswa::where('id_kelas', $id_kelas)->get()->groupBy('pertemuan');

        // Fetch all distinct pertemuan numbers dynamically
        $pertemuanNumbers = AbsensiMahasiswa::where('id_kelas', $id_kelas)
            ->distinct()
            ->pluck('pertemuan');

        return view('asisten.absensi.mahasiswaDetail', compact('kelas', 'mahasiswas', 'absensis', 'pertemuanNumbers'));
    }

    public function konfirmasi(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'pertemuan' => 'required|string',
            'id_kelas' => 'required|string',
            'npm' => 'required|array', // Ensure 'npm' is an array
            'keterangan' => 'required|array', // Ensure 'keterangan' is an array
        ]);
    
        try {
            // Loop through the npm and keterangan arrays
            foreach ($request->npm as $index => $npm) {
                $absensi = new AbsensiMahasiswa();
                $absensi->npm = $npm;
                $absensi->id_kelas = $request->id_kelas;
                $absensi->tanggal = $request->tanggal;
                $absensi->pertemuan = $request->pertemuan;
                $absensi->keterangan = $request->keterangan[$npm]; // Use the npm as key for keterangan
                $absensi->save();
            }
    
            return redirect()->back()->with('success', 'Attendance successfully confirmed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to confirm attendance: ' . $e->getMessage());
        }
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'npm' => 'required|array|min:1',
            'pertemuan' => 'required|integer|min:1',
            'id_kelas' => [
                'required',
                'exists:kelas,id_kelas',
                function ($attribute, $value, $fail) {
                    $asistenId = Auth::id();
                    if (!Kelas::where('id_kelas', $value)
                        ->whereHas('asistens', function ($query) use ($asistenId) {
                            $query->where('asistens.id', $asistenId);
                        })
                        ->exists()) {
                        $fail('Anda tidak memiliki akses ke kelas ini.');
                    }
                },
            ],
            'keterangan' => 'required|array',
            'keterangan.*' => 'required|in:HADIR,SAKIT,IZIN,ALPA',
        ]);
    
        $validNpms = Mahasiswa::whereHas('kelas', function ($query) use ($request) {
            $query->where('kelas.id_kelas', $request->id_kelas);
        })->whereIn('npm', $request->npm)->pluck('npm')->toArray();
    
        if (count($validNpms) !== count($request->npm)) {
            return back()->withErrors(['npm' => 'Beberapa mahasiswa tidak terdaftar di kelas ini.'])->withInput();
        }
    
        try {
            foreach ($request->npm as $npm) {
                if (!isset($request->keterangan[$npm])) {
                    return back()->withErrors(['keterangan' => "Mahasiswa dengan NPM {$npm} harus memiliki keterangan."])->withInput();
                }
    
                AbsensiMahasiswa::create([
                    'npm' => $npm,
                    'id_kelas' => $request->id_kelas,
                    'tanggal' => $request->tanggal,
                    'pertemuan' => $request->pertemuan,
                    'keterangan' => $request->keterangan[$npm],
                ]);
            }
    
            return redirect()->route('asisten.absensi.mahasiswa')->with('success', 'Absensi berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }
}
