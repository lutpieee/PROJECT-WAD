<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganApiController extends Controller
{
    // GET /api/ruangan
    public function index()
    {
        return response()->json(Ruangan::all(), 200);
    }

    // GET /api/ruangan/{id}
    public function show($id)
    {
        return response()->json(Ruangan::findOrFail($id), 200);
    }

    // POST /api/ruangan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_ruangan' => 'required|unique:ruangans',
            'kapasitas'     => 'required|integer',
            'status'        => 'required'
        ]);

        $ruangan = Ruangan::create($validated);

        return response()->json($ruangan, 201);
    }

    // PUT /api/ruangan/{id}
    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $ruangan->update($request->all());

        return response()->json($ruangan, 200);
    }

    // DELETE /api/ruangan/{id}
    public function destroy($id)
    {
        Ruangan::destroy($id);

        return response()->json(['message' => 'Ruangan deleted'], 200);
    }
}
