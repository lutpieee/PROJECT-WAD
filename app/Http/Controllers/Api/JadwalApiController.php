<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalApiController extends Controller
{
    // READ (User & Admin)
    public function index()
    {
        return Jadwal::with('ruangan')->get();
    }

    // CREATE (Admin)
    public function store(Request $request)
    {
        return Jadwal::create($request->all());
    }

    // UPDATE (Admin)
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if ($jadwal->status === 'booked') {
            return response()->json([
                'message' => 'Jadwal sudah dipakai'
            ], 403);
        }

        $jadwal->update($request->all());
        return $jadwal;
    }

    // DELETE (Admin)
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if ($jadwal->status === 'booked') {
            return response()->json([
                'message' => 'Tidak bisa hapus jadwal yang sudah dipakai'
            ], 403);
        }

        $jadwal->delete();
        return response()->json(['message' => 'Jadwal dihapus']);
    }
}