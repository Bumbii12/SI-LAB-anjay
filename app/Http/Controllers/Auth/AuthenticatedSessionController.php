<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        Log::info('Login attempt', ['email' => $request->email]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            Log::warning('User  not found', ['email' => $request->email]);
            return back()->withErrors(['email' => 'Akun tidak ditemukan.'])->withInput();
        }
    
        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            Log::warning('Password mismatch', ['email' => $request->email]);
            return back()->withErrors(['password' => 'Password tidak valid.'])->withInput();
        }
    
        Auth::login($user);
        $request->session()->regenerate();
    
        // Redirect logic
        if ($user->isAdmin()) {
            return redirect()->intended('/admin/dashboard');
        } elseif ($user->isAsisten()) {
            return redirect()->intended('/asisten/dashboard');
        }
    
        return redirect()->intended('/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}