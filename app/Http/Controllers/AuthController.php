<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    // =======================
    // VIEW LOGIN & REGISTER
    // =======================
    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    // =======================
    // REGISTER
    // =======================
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                'role' => 'required|in:admin,petugas,user'
            ]);
    
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
    
            return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withInput()->with('error', $e->validator->errors()->first());
        }
    }
    
    
    // =======================
    // LOGIN
    // =======================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
    
            return redirect()->route(
                $user->role === 'admin' ? 'admin.dashboard' :
                ($user->role === 'kepala_bagian' ? 'kepala.dashboard' : 'admin.dashboard')
            )->with('success', "Selamat datang, {$user->name}!");
        }
    
        return back()->withInput()->with('error', 'Email atau password salah!');
    }
    
    // =======================
    // LOGOUT
    // =======================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login')->with('success', 'Anda telah keluar dari sistem.');
    }
    

    public function index()
    {
        $users = User::all();
        return view('auth.users', compact('users'));
    }
    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('auth.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
    ]);

    $user->update($request->all());

    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
}

 // Menampilkan form tambah user
 public function create()
 {
     // Jika ingin role bisa dipilih dari beberapa opsi
     $roles = ['admin','petugas', 'user']; 
     return view('auth.create', compact('roles'));
 }

 // Menyimpan user baru
 public function store(Request $request)
 {
     // Validasi input
     $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|string|min:6|confirmed', // pastikan ada password_confirmation
         'role' => 'required|in:admin,user,petugas',
     ]);

     // Simpan user
     User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => bcrypt($request->password),
         'role' => $request->role,
     ]);

     return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
 }
}
