<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kelas;
class AsistenController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user(); // Get the authenticated assistant
        $classes = $user->kelas; // Use the relationship to fetch related classes

        return view('asisten.dashboard', compact('user', 'classes'));
    }
    
}
