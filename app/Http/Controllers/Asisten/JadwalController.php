<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktikum;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPraktikum::with(['kelas', 'asistens'])->get();

        return view('asisten.jadwal', compact('jadwals'));
    }
}


