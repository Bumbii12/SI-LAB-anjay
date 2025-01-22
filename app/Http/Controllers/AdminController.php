<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get logged-in user's data
        $user = Auth::user(); 
    
        // Ambil jumlah asisten dosen dari database
        $jumlahAsisten = Asisten::count();
        $totalMahasiswa = Mahasiswa::count();
    
        // Pass data ke view
        return view('admin.dashboard', compact('user', 'jumlahAsisten', 'totalMahasiswa'));
    }
    
}
