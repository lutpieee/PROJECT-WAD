<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    // Menampilkan semua data ruangan
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('admin.ruangan.index', compact('ruangans'));
    }

    // Form tambah ruangan
    public function create()
    {
        return view('admin.ruangan.create');
    }

    // Proses simpan ruangan
    public function store(Request $request)
    {
        $request->validate([
            'nomor_ruangan' => 'required|string|max:50',
            'kapasitas' => 'required|numeric|min:1',
            'status' => 'required|boolean',
        ]);

        Ruangan::create([
            'nomor_ruangan' => $request->nomor_ruangan,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.ruangan.index')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }

    // Form edit ruangan
    public function edit(Ruangan $ruangan)
    {
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    // Update ruangan
    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'nomor_ruangan' => 'required|string|max:50',
            'kapasitas' => 'required|numeric|min:1',
            'status' => 'required'
        ]);

        $ruangan->update([
            'nomor_ruangan' => $request->nomor_ruangan,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.ruangan.index')
            ->with('success', 'Ruangan berhasil diperbarui');
    }

    // Hapus data ruangan
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();

        return redirect()->route('admin.ruangan.index')
            ->with('success', 'Ruangan berhasil dihapus');
    }


    public function jadwalUser($id)
    {
        $ruangan = Ruangan::with('jadwal')->findOrFail($id);

        return view('user.jadwal', compact('ruangan'));
    }

    public function show($id)
    {
    $ruangan = Ruangan::findOrFail($id);

    // ambil jadwal yang dibuat admin berdasarkan id ruangan
    $jadwals = Jadwal::where('ruangan_id', $ruangan->id)
        ->orderBy('tanggal')
        ->orderBy('jam_mulai')
        ->get();

    return view('user.ruangan.jadwal', compact('ruangan', 'jadwals'));
}
}