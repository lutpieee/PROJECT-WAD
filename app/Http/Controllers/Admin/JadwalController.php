<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Ruangan;

class JadwalController extends Controller
{
    // READ (Admin lihat semua jadwal)
    public function index()
    {
        $jadwals  = Jadwal::with('ruangan')->orderBy('tanggal')->get();
        $ruangans = Ruangan::all();

        return view('admin.jadwal.index', compact('jadwals', 'ruangans'));
    }

    // CREATE - FORM TAMBAH JADWAL
    public function create()
    {
        $ruangans = Ruangan::all();

        return view('admin.jadwal.create', compact('ruangans'));
    }

    // STORE - SIMPAN JADWAL BARU
public function store(Request $request)
{
    $request->validate([
        'ruangan_id'  => 'required|exists:ruangans,id',
        'tanggal'     => 'required|date',
        'jam_mulai'   => 'required',
        'jam_selesai' => 'required|after:jam_mulai',
        'status'      => 'required|in:0,1'
    ]);

    Jadwal::create([
        'ruangan_id'  => $request->ruangan_id,
        'tanggal'     => $request->tanggal,
        'jam_mulai'   => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'status'      => $request->status
    ]);

    return redirect()
        ->route('admin.jadwal.index')
        ->with('success', 'Jadwal berhasil ditambahkan');
}
    // FORM EDIT
    public function edit($id)
    {
        $jadwal   = Jadwal::findOrFail($id);
        $ruangans = Ruangan::all();

        return view('admin.jadwal.edit', compact('jadwal', 'ruangans'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'tanggal'    => 'required|date',
            'jam_mulai'  => 'required',
            'jam_selesai'=> 'required|after:jam_mulai',
            'status'     => 'required'
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    // DELETE
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }
}
