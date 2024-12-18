<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TentangMhtqPimpinan;
use Illuminate\Http\Request;

class ApiTentangMhtqPimpinanController extends Controller
{
    // Menampilkan semua data TentangMhtqPimpinan
    public function index()
    {
        $tentangMhtqPimpinan = TentangMhtqPimpinan::all();
        return response()->json($tentangMhtqPimpinan, 200);
    }

    // Menyimpan data baru TentangMhtqPimpinan
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $tentangMhtqPimpinan = TentangMhtqPimpinan::create($request->all());

        return response()->json($tentangMhtqPimpinan, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $tentangMhtqPimpinan = TentangMhtqPimpinan::find($id);

        if (!$tentangMhtqPimpinan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($tentangMhtqPimpinan, 200);
    }

    // Memperbarui data TentangMhtqPimpinan berdasarkan ID
    public function update(Request $request, $id)
    {
        $tentangMhtqPimpinan = TentangMhtqPimpinan::find($id);

        if (!$tentangMhtqPimpinan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $tentangMhtqPimpinan->update($request->all());

        return response()->json($tentangMhtqPimpinan, 200);
    }

    // Menghapus data TentangMhtqPimpinan berdasarkan ID
    public function destroy($id)
    {
        $tentangMhtqPimpinan = TentangMhtqPimpinan::find($id);

        if (!$tentangMhtqPimpinan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tentangMhtqPimpinan->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
