<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::orderBy('status', 'desc')
                    ->orderBy('nomor_ruangan', 'asc')
                    ->get();

        $pendingCount = Peminjaman::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->count();

        $riwayatCount = Peminjaman::where('user_id', Auth::id())->count();

        return view('user.home', compact('ruangans', 'pendingCount', 'riwayatCount'));
    }

    public function jadwalRuangan($id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $jadwals = Jadwal::with('peminjamans')
            ->where('ruangan_id', $ruangan->id)
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        return view('user.ruangan.jadwal', compact('ruangan', 'jadwals'));
    }

    public function progress()
    {
        $peminjamans = Peminjaman::with(['jadwal.ruangan'])
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'approved', 'rejected'])
            ->latest()
            ->get();

        return view('user.progress', compact('peminjamans'));
    }

    public function riwayat()
    {
        $peminjamans = Peminjaman::with(['jadwal.ruangan'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.riwayat', compact('peminjamans'));
    }
}
