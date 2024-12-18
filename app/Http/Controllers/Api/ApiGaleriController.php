<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class ApiGaleriController extends Controller
{
    // Menampilkan semua data Galeri
    public function index()
    {
        $galeris = Galeri::all();
        return response()->json($galeris, 200);
    }

    // Menyimpan data baru Galeri
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'jenis_galeri' => 'required|in:' . implode(',', Galeri::getJenisGaleriOptions()),
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048', // Gambar opsional, max 2MB
        ]);

        // Proses upload gambar jika ada
        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('galeri_images', 'public');
            $data['gambar'] = $gambarPath;
        }

        $galeri = Galeri::create($data);

        return response()->json($galeri, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($galeri, 200);
    }

    // Memperbarui data Galeri berdasarkan ID
    public function update(Request $request, $id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'jenis_galeri' => 'sometimes|in:' . implode(',', Galeri::getJenisGaleriOptions()),
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('galeri_images', 'public');
            $data['gambar'] = $gambarPath;
        }

        $galeri->update($data);

        return response()->json($galeri, 200);
    }

    // Menghapus data Galeri berdasarkan ID
    public function destroy($id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $galeri->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
