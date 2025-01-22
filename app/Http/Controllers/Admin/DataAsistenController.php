<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Asisten;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DataAsistenController extends Controller
{
    public function index()
    { 
        $kelas = Kelas::all();
        $mahasiswa = Mahasiswa::all();
        $asistens = Asisten::with('kelas', 'mahasiswa')->paginate(1);
        
        return view('admin.data.asisten', compact('kelas', 'asistens', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        Log::info($request->all());

        $request->validate([
            'npm' => 'required|exists:mahasiswas,npm|unique:asistens,npm', // Check if npm is unique in asistens
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|array',
            'kelas_id.*' => 'exists:kelas,id_kelas',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
        ], [
            'npm.required' => 'NPM wajib diisi.',
            'npm.exists' => 'NPM yang dimasukkan tidak terdaftar.',
            'npm.unique' => 'NPM sudah terdaftar sebagai asisten.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'kelas_id.required' => 'Pilih minimal satu kelas.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus terdiri dari minimal 6 karakter.',
            'photo.image' => 'File foto harus berupa gambar.',
            'photo.mimes' => 'Format foto yang diperbolehkan: jpeg, png, jpg, gif.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        Log::info('Request data', ['request' => $request->all()]);

        // Buat User baru
        $user = new User();
        $user->npm = $request->npm;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'asisten';
        $user->no_hp = '';

        // Logika penyimpanan foto
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            
            if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                Log::error('Invalid file type', ['mime' => $file->getMimeType()]);
                return redirect()->back()->withErrors(['photo' => 'File harus berupa gambar dengan format jpeg, png, jpg, atau gif.']);
            }
            
            if ($file->getSize() > 2048000) {
                Log::error('File too large', ['size' => $file->getSize()]);
                return redirect()->back()->withErrors(['photo' => 'Ukuran file tidak boleh lebih dari 2MB.']);
            }
            
            $filename = time() . '.' . $file->getClientOriginalExtension();
            
            try {
                $file->move(public_path('uploads/photos'), $filename);
                $user->photo = $filename; // Simpan nama file foto ke kolom photo di tabel users
            } catch (\Exception $e) {
                Log::error('Failed to move file for user', ['error' => $e->getMessage()]);
                return redirect()->back()->withErrors(['photo' => 'Gagal mengunggah foto untuk pengguna.']);
            }
        }

        $user->save();

        if (!$user->exists) {
            Log::error('User not saved', ['user' => $user]);
        }
        
        // Buat Asisten baru
        $asisten = new Asisten();
        $asisten->npm = $request->npm;
        $asisten->nama = $request->nama;

        // Simpan nama file foto ke kolom photo di tabel asisten
        if (isset($filename)) {
            $asisten->photo = $filename; // Simpan nama file foto ke kolom photo di tabel asisten
        }

        $asisten->save();

        if (!$asisten->exists) {
            Log::error('Asisten not saved', ['asisten' => $asisten]);
        }

        // Hubungkan dengan kelas
        $asisten->kelas()->sync($request->kelas_id);
        
        return redirect()->back()->with('success', 'Asisten dan akun berhasil ditambahkan.');
    }

    public function getNama(Request $request)
    {
        $npm = $request->query('npm');
        $mahasiswa = Mahasiswa::where('npm', $npm)->first();

        if ($mahasiswa) {
            return response()->json(['nama' => $mahasiswa->nama]);
        }

        return response()->json(['nama' => null]);
    }

    public function edit($id)
    {
        $asisten = Asisten::with('kelas')->findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.data.edit_asisten', compact('asisten', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'npm' => 'required|exists:mahasiswas,npm|unique:asistens,npm,' . $id, // Allow the current asisten's npm to remain the same
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|array',
            'kelas_id.*' => 'exists:kelas,id_kelas',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ], [
            'npm.required' => 'NPM wajib diisi.',
            'npm.exists' => 'NPM yang dimasukkan tidak terdaftar.',
            'npm.unique' => 'NPM sudah terdaftar sebagai asisten.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'kelas_id.required' => 'Pilih minimal satu kelas.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.min' => 'Password harus terdiri dari minimal 6 karakter.',
        ]);

        $asisten = Asisten::findOrFail($id);
        $user = User::where('npm', $asisten->npm)->first();

        if ($user) {
            $user->npm = $request->npm;
            $user->name = $request->nama;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
        }

        $asisten->update([
            'npm' => $request->npm,
            'nama' => $request->nama,
        ]);

        // Update relasi kelas
        $asisten->kelas()->sync($request->kelas_id);

        return redirect()->route('data.asistens.index')->with('success', 'Asisten dan akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $asisten = Asisten::findOrFail($id);
        $user = User::where('npm', $asisten->npm)->first();

        // Hapus relasi kelas
        $asisten->kelas()->detach();

        // Hapus data asisten
        $asisten->delete();

        // Hapus user jika ada
        if ($user) {
            $user->delete();
        }

        return redirect()->back()->with('success', 'Asisten dan akun berhasil dihapus.');
    }
}
