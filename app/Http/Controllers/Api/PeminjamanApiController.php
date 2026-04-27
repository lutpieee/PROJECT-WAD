<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Jadwal; 
use Illuminate\Http\Request;

class PeminjamanApiController extends Controller
{
    // USER: ajukan peminjaman
    public function store(Request $request)
    {
        $request->validate([
        'jadwal_id' => 'required|exists:jadwals,id',
        'keperluan' => 'required',
        'jam' => 'required|date_format:H:i' // format jam 24-jam, misal 14:00
    ]);

    $jadwal = Jadwal::findOrFail($request->jadwal_id);

    if ($jadwal->status !== 'available') {
        return response()->json(['message' => 'Jadwal tidak tersedia'], 403);
    }

    return Peminjaman::create([
       // 'user_id' => auth()->id(),
        'jadwal_id' => $jadwal->id,
        'keperluan' => $request->keperluan,
        'jam' => $request->jam, // tambahkan jam
        'status' => 'menunggu' // default status
    ]);
    }

    // USER: lihat peminjaman sendiri
    public function my()
    {
        return Peminjaman::where('user_id', auth()->id())
            ->with('jadwal.ruangan')
            ->get();
    }

    // ADMIN: lihat semua
    public function index()
    {
        return Peminjaman::with(['user', 'jadwal.ruangan'])->get();
    }

  
    // USER: batalkan (jika menunggu)
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if (
            $peminjaman->user_id !== auth()->id() ||
            $peminjaman->status !== 'menunggu'
        ) {
            abort(403);
        }

        $peminjaman->delete();
    }
}
