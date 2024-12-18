<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TentangMhtqPendiri;
use Illuminate\Http\Request;

class ApiTentangMhtqPendiriController extends Controller
{
    // Menampilkan semua data TentangMhtqPendiri
    public function index()
    {
        $tentangMhtqPendiri = TentangMhtqPendiri::all();
        return response()->json($tentangMhtqPendiri, 200);
    }

    // Menyimpan data baru TentangMhtqPendiri
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $tentangMhtqPendiri = TentangMhtqPendiri::create($request->all());

        return response()->json($tentangMhtqPendiri, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $tentangMhtqPendiri = TentangMhtqPendiri::find($id);

        if (!$tentangMhtqPendiri) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($tentangMhtqPendiri, 200);
    }

    // Memperbarui data TentangMhtqPendiri berdasarkan ID
    public function update(Request $request, $id)
    {
        $tentangMhtqPendiri = TentangMhtqPendiri::find($id);

        if (!$tentangMhtqPendiri) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $tentangMhtqPendiri->update($request->all());

        return response()->json($tentangMhtqPendiri, 200);
    }

    // Menghapus data TentangMhtqPendiri berdasarkan ID
    public function destroy($id)
    {
        $tentangMhtqPendiri = TentangMhtqPendiri::find($id);

        if (!$tentangMhtqPendiri) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tentangMhtqPendiri->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
