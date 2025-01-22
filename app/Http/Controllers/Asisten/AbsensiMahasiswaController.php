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
        
        // Retrieve the classes managed by the assistant (based on the asisten's ID)
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
            ->firstOrFail(); // If the class is not found, it will throw a 404

        // Fetch students enrolled in this class
        $mahasiswas = $kelas->mahasiswas;

        return view('asisten.absensi.mahasiswaDetail', compact('kelas', 'mahasiswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'npm' => 'required|array|min:1',
            'pertemuan' => 'required',
            'id_kelas' => [
                'required',
                'exists:kelas,id_kelas',
                function ($attribute, $value, $fail) {
                    $asistenId = Auth::id();
                    // Memastikan kelas yang dipilih adalah kelas yang dikelola oleh asisten yang sedang login
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

        // Memeriksa mahasiswa yang terdaftar di kelas ini
        $validNpms = Mahasiswa::whereHas('kelas', function ($query) use ($request) {
            $query->where('kelas.id_kelas', $request->id_kelas);
        })->whereIn('npm', $request->npm)->pluck('npm')->toArray();

        // Memastikan semua mahasiswa yang dipilih terdaftar di kelas ini
        if (count($validNpms) !== count($request->npm)) {
            return back()->withErrors(['npm' => 'Beberapa mahasiswa tidak terdaftar di kelas ini'])->withInput();
        }

        // Menyimpan data absensi mahasiswa
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
}
