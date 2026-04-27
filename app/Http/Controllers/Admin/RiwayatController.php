<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class RiwayatController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user','jadwal.ruangan'])
            ->latest()
            ->get();

        return view('admin.riwayat.index', compact('peminjamans'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with(['user','jadwal.ruangan'])
            ->findOrFail($id);

        return view('admin.riwayat.edit', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = $request->status;
        $peminjaman->save();

        return redirect()
            ->route('admin.riwayat.index')
            ->with('success', 'Status peminjaman berhasil diperbarui');
    }
}
