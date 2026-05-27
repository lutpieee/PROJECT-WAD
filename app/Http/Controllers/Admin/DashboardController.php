<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_users' => User::count(),
            'total_ruangan' => Ruangan::count(),
            'ruangan_tersedia' => Ruangan::where('status', true)->count(),
            'total_jadwal' => Jadwal::count(),
            'pending_approval' => Peminjaman::where('status', 'pending')->count(),
            'approved_peminjaman' => Peminjaman::where('status', 'approved')->count(),
            'rejected_peminjaman' => Peminjaman::where('status', 'rejected')->count(),
            'total_peminjaman' => Peminjaman::count(),
        ];

        $recentPeminjamans = Peminjaman::with(['user', 'jadwal.ruangan'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('data', 'recentPeminjamans'));
    }
}
