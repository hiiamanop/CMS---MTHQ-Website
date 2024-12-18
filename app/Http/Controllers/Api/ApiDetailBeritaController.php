<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailBerita;
use Illuminate\Http\Request;

class ApiDetailBeritaController extends Controller
{
    // Menampilkan semua data DetailBerita
    public function index()
    {
        $detailBerita = DetailBerita::with('listBerita')->get(); // Termasuk relasi
        return response()->json($detailBerita, 200);
    }

    // Menyimpan data baru DetailBerita
    public function store(Request $request)
    {
        $request->validate([
            'list_berita_id' => 'required|exists:list_beritas,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $detailBerita = DetailBerita::create($request->all());

        return response()->json($detailBerita, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $detailBerita = DetailBerita::with('listBerita')->find($id);

        if (!$detailBerita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($detailBerita, 200);
    }

    // Memperbarui data DetailBerita berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'list_berita_id' => 'sometimes|exists:list_beritas,id',
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $detailBerita = DetailBerita::find($id);

        if (!$detailBerita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $detailBerita->update($request->all());

        return response()->json($detailBerita, 200);
    }

    // Menghapus data DetailBerita berdasarkan ID
    public function destroy($id)
    {
        $detailBerita = DetailBerita::find($id);

        if (!$detailBerita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $detailBerita->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
