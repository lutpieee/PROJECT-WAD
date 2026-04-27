<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class AdminApprovalController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'jadwal.ruangan'])
            ->where('status', 'pending')
            ->get();

        return view('admin.approval.index', compact('peminjamans'));
    }
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Peminjaman disetujui');
    }
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'rejected'
        ]);
        return back()->with('success', 'Peminjaman ditolak');
    }
}
