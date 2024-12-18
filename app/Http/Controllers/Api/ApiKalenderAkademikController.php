<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class ApiKalenderAkademikController extends Controller
{
    // Menampilkan semua data KalenderAkademik
    public function index()
    {
        $kalenderAkademik = KalenderAkademik::all();
        return response()->json($kalenderAkademik, 200);
    }

    // Menyimpan data baru KalenderAkademik
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048', // Gambar opsional, max 2MB
        ]);

        // Proses upload gambar jika ada
        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kalender_akademik_images', 'public');
            $data['gambar'] = $gambarPath;
        }

        $kalenderAkademik = KalenderAkademik::create($data);

        return response()->json($kalenderAkademik, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $kalenderAkademik = KalenderAkademik::find($id);

        if (!$kalenderAkademik) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($kalenderAkademik, 200);
    }

    // Memperbarui data KalenderAkademik berdasarkan ID
    public function update(Request $request, $id)
    {
        $kalenderAkademik = KalenderAkademik::find($id);

        if (!$kalenderAkademik) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kalender_akademik_images', 'public');
            $data['gambar'] = $gambarPath;
        }

        $kalenderAkademik->update($data);

        return response()->json($kalenderAkademik, 200);
    }

    // Menghapus data KalenderAkademik berdasarkan ID
    public function destroy($id)
    {
        $kalenderAkademik = KalenderAkademik::find($id);

        if (!$kalenderAkademik) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $kalenderAkademik->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
