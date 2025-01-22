<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswa;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilAbsensiExport;
use App\Models\Kelas;
use App\Models\Mahasiswa;

class HasilAbsensiMahasiswaController extends Controller
{

    public function index()
    {
        
        // Ambil data kelas yang dibagi berdasarkan semester dan mata proyek
        $proyekGanjil = Kelas::where('semester', 'Ganjil')->get()->groupBy('mata_proyek');
        $proyekGenap = Kelas::where('semester', 'Genap')->get()->groupBy('mata_proyek');

        // Kirim data kelas yang dibagi per semester ke view
        return view('admin.hasil-absensi.absensi_mahasiswa', compact('proyekGanjil', 'proyekGenap'));
    }

    public function rekapAbsensi($id_kelas)
    {
        // Ambil data kelas berdasarkan id_kelas
        $kelas = Kelas::findOrFail($id_kelas);
        
        // Ambil mahasiswa yang terdaftar di kelas tersebut
        $mahasiswas = Mahasiswa::whereHas('kelas', function ($query) use ($id_kelas) {
            $query->where('kelas.id_kelas', $id_kelas);
        })->get();

        $rekapAbsensi = [];
        $totalPertemuan = 8; // Asumsi total pertemuan adalah 8
        $totalKehadiran = 0;

        // Proses absensi untuk setiap mahasiswa
        foreach ($mahasiswas as $mahasiswa) {
            $absensi = AbsensiMahasiswa::where('id_kelas', $id_kelas) 
                ->where('npm', $mahasiswa->npm)
                ->get();
                
            $hadirCount = $absensi->where('keterangan', 'HADIR')->count();

            // Hitung total kehadiran
            $totalKehadiran += $hadirCount;

            // Tambahkan data rekap absensi mahasiswa
            $rekapAbsensi[] = [
                'npm' => $mahasiswa->npm,
                'nama' => $mahasiswa->nama,
                'kehadiran' => $hadirCount,
                'totalPertemuan' => $totalPertemuan,
                'persentase' => round(($hadirCount / $totalPertemuan) * 100, 2),
            ];
        }

        
        // Kirim data ke view
        return view('admin.hasil-absensi.hasil-absen-mahasiswa', [
            'kelas' => $kelas,
            'rekapAbsensi' => $rekapAbsensi,
            'totalPertemuan' => $totalPertemuan,
            'totalKehadiran' => $totalKehadiran,
        ]);
    }
}


    // public function downloadPDF()
    // {
    //     $absensis = AbsensiMahasiswa::with(['mahasiswa', 'kelas'])->get();

    //     $absensis = $absensis->groupBy('mahasiswa_id')->map(function ($items) {
    //         $totalPertemuan = $items->count();
    //         $hadir = $items->where('status', 'Hadir')->count();

    //         return [
    //             'mahasiswa' => $items->first()->mahasiswa,
    //             'kelas' => $items->first()->kelas,
    //             'pertemuan' => $items->pluck('status'),
    //             'persentase' => $totalPertemuan > 0 ? round(($hadir / $totalPertemuan) * 100, 2) : 0,
    //         ];
    //     });

    //     $pdf = PDF::loadView('admin.hasil-absensi.hasilpdf', compact('absensis'));
    //     return $pdf->download('hasil_absensi.pdf');
    // }

//     public function downloadExcel()
//     {
//         return Excel::download(new HasilAbsensiExport, 'hasil_absensi.xlsx');
//     }
// }