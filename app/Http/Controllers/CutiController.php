<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class CutiController extends Controller
{
    // Admin melihat semua cuti
    public function index()
    {
        $cutis = Cuti::with('pegawai')->latest()->get();
        return view('admin.cuti.index', compact('cutis'));
    }

    // Pegawai melihat riwayat cuti mereka
    public function indexPegawai()
    {
        $cutis = Cuti::where('user_id', Auth::id())->latest()->get();
        return view('pegawai.cuti.index', compact('cutis'));
    }

    // Form ajukan cuti
    public function create()
    {
        return view('pegawai.cuti.create');
    }

    // Simpan cuti
    
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:1000',
        ]);
    
        $userId = Auth::id();
        $start = Carbon::parse($request->tanggal_mulai);
        $end = Carbon::parse($request->tanggal_selesai);
        $durasi = $start->diffInDays($end) + 1;
    
        // 🔴 Tidak boleh lebih dari 1 hari dalam 1 pengajuan
        if ($durasi > 1) {
            return back()->withErrors([
                'tanggal_selesai' => 'Cuti hanya boleh 1 hari dalam 1 bulan.'
            ])->withInput();
        }
    
        // 🔴 Cek apakah sudah pernah cuti di bulan yang sama
        $existingCutiBulanIni = DB::table('cutis')
            ->where('user_id', $userId)
            ->whereMonth('tanggal_mulai', $start->month)
            ->whereYear('tanggal_mulai', $start->year)
            ->count();
    
        if ($existingCutiBulanIni > 0) {
            return back()->withErrors([
                'tanggal_mulai' => 'Anda sudah pernah cuti di bulan ini. Maksimal 1 hari per bulan.'
            ])->withInput();
        }
    
        // 🟡 Total cuti per tahun
        $totalCutiTahunIni = DB::table('cutis')
            ->where('user_id', $userId)
            ->whereYear('tanggal_mulai', now()->year)
            ->sum(DB::raw('DATEDIFF(tanggal_selesai, tanggal_mulai) + 1'));
    
        if ($totalCutiTahunIni + $durasi > 12) {
            return back()->withErrors([
                'tanggal_mulai' => 'Anda telah melebihi batas maksimal 12 hari cuti dalam setahun.'
            ])->withInput();
        }
    
        // ✅ Simpan cuti
        Cuti::create([
            'user_id' => $userId,
            'tanggal_mulai' => $start,
            'tanggal_selesai' => $end,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);
    
        return redirect()->route('pegawai.cuti.index')->with('success', 'Pengajuan cuti berhasil dikirim.');
    }
    
    // Admin ubah status cuti
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,disetujui,ditolak']);

        $cuti = Cuti::findOrFail($id);
        $cuti->update(['status' => $request->status]);

        return back()->with('success', 'Status cuti berhasil diperbarui.');
    }

    public function laporanCuti()
{
    $pegawais = User::where('role', 'pegawai')
        ->with(['cutis' => function($query) {
            $query->select('user_id', DB::raw('SUM(DATEDIFF(tanggal_selesai, tanggal_mulai) + 1) as total_hari'))
                ->groupBy('user_id');
        }])->get();

    return view('admin.cuti.laporan', compact('pegawais'));
}

}
