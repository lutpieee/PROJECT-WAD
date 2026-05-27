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
        $validated = $request->validate([
            'ruangan_id'  => 'required|exists:ruangans,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status'      => 'required|in:available,booked,blocked',
        ]);

        if ($this->hasScheduleConflict($validated)) {
            return back()
                ->withErrors(['jam_mulai' => 'Jadwal bentrok dengan jadwal lain pada ruangan dan tanggal yang sama.'])
                ->withInput();
        }

        Jadwal::create($validated);

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
        $validated = $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'tanggal'    => 'required|date',
            'jam_mulai'  => 'required|date_format:H:i',
            'jam_selesai'=> 'required|date_format:H:i|after:jam_mulai',
            'status'     => 'required|in:available,booked,blocked',
        ]);

        if ($this->hasScheduleConflict($validated, $id)) {
            return back()
                ->withErrors(['jam_mulai' => 'Jadwal bentrok dengan jadwal lain pada ruangan dan tanggal yang sama.'])
                ->withInput();
        }

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($validated);

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

    private function hasScheduleConflict(array $data, ?int $ignoreId = null): bool
    {
        return Jadwal::query()
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->where('ruangan_id', $data['ruangan_id'])
            ->whereDate('tanggal', $data['tanggal'])
            ->where('jam_mulai', '<', $data['jam_selesai'])
            ->where('jam_selesai', '>', $data['jam_mulai'])
            ->exists();
    }
}
