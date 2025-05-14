<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PegawaiController extends Controller
{
    /**
     * Tampilkan daftar semua pegawai.
     */
    public function indexPegawai()
    {
        $pegawais = User::where('role', 'pegawai')->get();
        return view('admin.pegawai.index', compact('pegawais'));
    }

    public function createPegawai()
    {
        return view('admin.pegawai.create');
    }

    public function storePegawai(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $password = Str::random(8);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => $password, // 💥 password tidak di-hash
            'role' => 'pegawai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan. Password: ' . $password);
    }

    public function editPegawai($id)
    {
        $pegawai = User::where('role', 'pegawai')->findOrFail($id);
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function updatePegawai(Request $request, $id)
    {
        $pegawai = User::where('role', 'pegawai')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $pegawai->update($request->only('name', 'email', 'tanggal_lahir', 'jenis_kelamin'));

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }


    public function showPegawai($id)
    {
        $pegawai = User::where('role', 'pegawai')->findOrFail($id);
        return view('admin.pegawai.show', compact('pegawai'));
    }


    public function destroyPegawai($id)
    {
        $pegawai = User::where('role', 'pegawai')->findOrFail($id);
        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }



    public function index()
    {
        $pegawais = Pegawai::latest()->get();
        return view('pegawai.index', compact('pegawais'));
    }

    public function dashboard()
{
    return view('pegawai.dashboard');
}


    /**
     * Tampilkan form untuk menambah pegawai baru.
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Simpan data pegawai ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'email' => 'required|email|unique:pegawais,email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit data pegawai.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update data pegawai.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_depan' => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'email' => 'required|email|unique:pegawais,email,' . $pegawai->id,
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Hapus data pegawai.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }

    public function profile()
{
    return view('pegawai.profile');
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
    ]);

    $user->update($request->only('name', 'email', 'tanggal_lahir', 'jenis_kelamin'));

    return redirect()->route('pegawai.profile')->with('success', 'Profile berhasil diperbarui.');
}

}
