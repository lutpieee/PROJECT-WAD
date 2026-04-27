<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Mengambil data statistik untuk dashboard
        

        // MENGAMBIL DATA RUANGAN (Variabel ini yang error di gambar kamu)
        $ruangans = Ruangan::orderBy('status', 'desc')
                    ->orderBy('nomor_ruangan', 'asc')
                    ->get();

        // Pastikan view yang dipanggil sesuai dengan lokasi file blade kamu
        // Jika file blade ada di resources/views/user/home.blade.php maka:
        return view('user.home', compact( 'ruangans'));
        $jadwals = Jadwal::with('peminjamans')->where('ruangan_id', $id)->get();
        return view('user.ruangan.jadwal', compact('ruangans', 'jadwals'));
    }
}