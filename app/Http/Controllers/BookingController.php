<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'keperluan' => 'required|string'
        ]);

        $jadwal = Jadwal::with('peminjamans')->findOrFail($request->jadwal_id);

        $isUnavailable = $jadwal->status !== 'available'
            || $jadwal->peminjamans()
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

        if ($isUnavailable) {
            return back()->withErrors([
                'jadwal_id' => 'Jadwal ini sedang diproses atau sudah dibooking.',
            ])->withInput();
        }

        Peminjaman::create([
            'user_id'   => Auth::id(),
            'jadwal_id' => $request->jadwal_id,
            'keperluan' => $request->keperluan,
            'status'    => 'pending'
        ]);

        return back()->with(
            'success',
            'Pengajuan pinjaman berhasil dikirim'
        );
    }
}
