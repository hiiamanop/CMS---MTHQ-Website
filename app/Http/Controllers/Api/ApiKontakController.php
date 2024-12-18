<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class ApiKontakController extends Controller
{
    // Menampilkan semua data Kontak
    public function index()
    {
        $kontak = Kontak::all();
        return response()->json($kontak, 200);
    }

    // Menyimpan data baru Kontak
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $kontak = Kontak::create($request->all());

        return response()->json($kontak, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $kontak = Kontak::find($id);

        if (!$kontak) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($kontak, 200);
    }

    // Memperbarui data Kontak berdasarkan ID
    public function update(Request $request, $id)
    {
        $kontak = Kontak::find($id);

        if (!$kontak) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $kontak->update($request->all());

        return response()->json($kontak, 200);
    }

    // Menghapus data Kontak berdasarkan ID
    public function destroy($id)
    {
        $kontak = Kontak::find($id);

        if (!$kontak) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $kontak->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
