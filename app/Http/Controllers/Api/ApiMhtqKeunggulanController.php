<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MhtqKeunggulan;
use Illuminate\Http\Request;

class ApiMhtqKeunggulanController extends Controller
{
    // Menampilkan semua data MhtqKeunggulan
    public function index()
    {
        $mhtqKeunggulan = MhtqKeunggulan::all();
        return response()->json($mhtqKeunggulan, 200);
    }

    // Menyimpan data baru MhtqKeunggulan
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $mhtqKeunggulan = MhtqKeunggulan::create($request->all());

        return response()->json($mhtqKeunggulan, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $mhtqKeunggulan = MhtqKeunggulan::find($id);

        if (!$mhtqKeunggulan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($mhtqKeunggulan, 200);
    }

    // Memperbarui data MhtqKeunggulan berdasarkan ID
    public function update(Request $request, $id)
    {
        $mhtqKeunggulan = MhtqKeunggulan::find($id);

        if (!$mhtqKeunggulan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $mhtqKeunggulan->update($request->all());

        return response()->json($mhtqKeunggulan, 200);
    }

    // Menghapus data MhtqKeunggulan berdasarkan ID
    public function destroy($id)
    {
        $mhtqKeunggulan = MhtqKeunggulan::find($id);

        if (!$mhtqKeunggulan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $mhtqKeunggulan->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
