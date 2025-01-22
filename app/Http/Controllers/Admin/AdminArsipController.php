<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArsipPrak;

class AdminArsipController extends Controller
{
    public function index()
    {
        // Ambil semua data arsip
        $arsipPraks = ArsipPrak::paginate(1);

        // Tampilkan view khusus admin
        return view('admin.arsip.arsip', compact('arsipPraks'));
    }

    public function destroy($id)
    {
        // Cari arsip berdasarkan ID
        $arsip = ArsipPrak::findOrFail($id);

        // Hapus data dari database
        $arsip->delete();

        // Redirect ke halaman admin dengan pesan sukses
        return redirect()->route('admin.arsip')->with('success', 'Data berhasil dihapus.');
    }
}