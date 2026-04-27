<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
