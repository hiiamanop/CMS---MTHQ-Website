<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MhtqFasilitas;
use Illuminate\Http\Request;

class ApiMhtqFasilitasController extends Controller
{
    // Menampilkan semua data MhtqFasilitas
    public function index()
    {
        $mhtqFasilitas = MhtqFasilitas::all();
        return response()->json($mhtqFasilitas, 200);
    }

    // Menyimpan data baru MhtqFasilitas
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $mhtqFasilitas = MhtqFasilitas::create($request->all());

        return response()->json($mhtqFasilitas, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $mhtqFasilitas = MhtqFasilitas::find($id);

        if (!$mhtqFasilitas) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($mhtqFasilitas, 200);
    }

    // Memperbarui data MhtqFasilitas berdasarkan ID
    public function update(Request $request, $id)
    {
        $mhtqFasilitas = MhtqFasilitas::find($id);

        if (!$mhtqFasilitas) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $mhtqFasilitas->update($request->all());

        return response()->json($mhtqFasilitas, 200);
    }

    // Menghapus data MhtqFasilitas berdasarkan ID
    public function destroy($id)
    {
        $mhtqFasilitas = MhtqFasilitas::find($id);

        if (!$mhtqFasilitas) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $mhtqFasilitas->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
