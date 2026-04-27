<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class RiwayatPeminjamanController extends Controller
{
    // GET /api/riwayat-peminjaman
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user','jadwal.ruangan']);

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->get()
        ]);
    }

    // GET /api/riwayat-peminjaman/{id}
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user','jadwal.ruangan'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $peminjaman
        ]);
    }
}