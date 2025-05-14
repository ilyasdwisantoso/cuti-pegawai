<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form register.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses penyimpanan akun baru (register).
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'password'       => 'required|string|min:6|confirmed',
        ]);
    
        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'password'       => Hash::make($request->password),
            'role'           => 'pegawai', // 💡 Hanya pegawai
        ]);
    
        Auth::login($user);
    
        // Redirect langsung ke dashboard pegawai
        return redirect()->intended(route('pegawai.dashboard'));
    }
    
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        // ✅ Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } elseif ($user->role === 'pegawai') {
            return redirect()->intended(route('pegawai.dashboard'));
        }

        return redirect()->intended('/');
    }

    return back()->withInput($request->only('email'))
                 ->withErrors(['email' => 'Email atau password salah.']);
}


    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
