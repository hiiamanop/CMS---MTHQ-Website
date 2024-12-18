<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MhtqDua;
use Illuminate\Http\Request;

class ApiMhtqDuaController extends Controller
{
    // Menampilkan semua data MhtqDua
    public function index()
    {
        $mhtqDua = MhtqDua::all();
        return response()->json($mhtqDua, 200);
    }

    // Menyimpan data baru MhtqDua
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $mhtqDua = MhtqDua::create($request->all());

        return response()->json($mhtqDua, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $mhtqDua = MhtqDua::find($id);

        if (!$mhtqDua) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($mhtqDua, 200);
    }

    // Memperbarui data MhtqDua berdasarkan ID
    public function update(Request $request, $id)
    {
        $mhtqDua = MhtqDua::find($id);

        if (!$mhtqDua) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $mhtqDua->update($request->all());

        return response()->json($mhtqDua, 200);
    }

    // Menghapus data MhtqDua berdasarkan ID
    public function destroy($id)
    {
        $mhtqDua = MhtqDua::find($id);

        if (!$mhtqDua) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $mhtqDua->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
