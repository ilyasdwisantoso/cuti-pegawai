<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.index', compact('admins'));
    }


    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit(User $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $admin->update($request->only('name', 'email', 'tanggal_lahir', 'jenis_kelamin'));

        return redirect()->route('admin.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }


    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}
