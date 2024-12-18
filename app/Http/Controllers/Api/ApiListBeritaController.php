<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ListBerita;
use Illuminate\Http\Request;

class ApiListBeritaController extends Controller
{
    // Menampilkan semua data ListBerita
    public function index()
    {
        $listBerita = ListBerita::all();
        return response()->json($listBerita, 200);
    }

    // Menyimpan data baru ListBerita
    public function store(Request $request)
    {
        $request->validate([
            'judul_berita' => 'required|string|max:255',
            'kategori_berita' => 'required|string|max:255',
            'tanggal_upload' => 'required|date',
            'highlight_berita' => 'nullable|string',
        ]);

        $listBerita = ListBerita::create($request->all());

        return response()->json($listBerita, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $listBerita = ListBerita::find($id);

        if (!$listBerita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($listBerita, 200);
    }

    // Memperbarui data ListBerita berdasarkan ID
    public function update(Request $request, $id)
    {
        $listBerita = ListBerita::find($id);

        if (!$listBerita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'judul_berita' => 'sometimes|string|max:255',
            'kategori_berita' => 'sometimes|string|max:255',
            'tanggal_upload' => 'sometimes|date',
            'highlight_berita' => 'nullable|string',
        ]);

        $listBerita->update($request->all());

        return response()->json($listBerita, 200);
    }

    // Menghapus data ListBerita berdasarkan ID
    public function destroy($id)
    {
        $listBerita = ListBerita::find($id);

        if (!$listBerita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $listBerita->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
