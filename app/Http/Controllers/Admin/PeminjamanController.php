<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{

    public function index()
{
    $peminjaman = Peminjaman::with(['user', 'jadwal.ruangan'])
        ->where('status', 'pending')
        ->get();

    return view('admin.approval.index', compact('peminjaman'));
}

    // APPROVE PEMINJAMAN
    public function approve($id)
    {
        // 1. Ambil data peminjaman + jadwal
        $peminjaman = Peminjaman::with('jadwal')->findOrFail($id);

        // 2. Cegah approval ganda
        if ($peminjaman->status !== 'pending') {
            return response()->json([
                'message' => 'Peminjaman sudah diproses'
            ], 400);
        }

        // 3. Update status peminjaman
        $peminjaman->update([
            'status' => 'approved'
        ]);

        // 4. Update status jadwal
        $peminjaman->jadwal->update([
            'status' => 'booked'
        ]);

        return response()->json([
            'message' => 'Peminjaman berhasil disetujui'
        ]);
    }

    // REJECT PEMINJAMAN
    public function reject($id)
    {
        // 1. Ambil data peminjaman
        $peminjaman = Peminjaman::findOrFail($id);

        // 2. Cegah reject ganda
        if ($peminjaman->status !== 'pending') {
            return response()->json([
                'message' => 'Peminjaman sudah diproses'
            ], 400);
        }

        // 3. Update status peminjaman
        $peminjaman->update([
            'status' => 'rejected'
        ]);

        return response()->json([
            'message' => 'Peminjaman ditolak'
        ]);
    }
}
