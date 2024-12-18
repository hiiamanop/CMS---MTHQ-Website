<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TentangMhtqProfile;
use Illuminate\Http\Request;

class ApiTentangMhtqProfileController extends Controller
{
    // Menampilkan semua data TentangMhtqProfile
    public function index()
    {
        $tentangMhtqProfile = TentangMhtqProfile::all();
        return response()->json($tentangMhtqProfile, 200);
    }

    // Menyimpan data baru TentangMhtqProfile
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $tentangMhtqProfile = TentangMhtqProfile::create($request->all());

        return response()->json($tentangMhtqProfile, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $tentangMhtqProfile = TentangMhtqProfile::find($id);

        if (!$tentangMhtqProfile) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($tentangMhtqProfile, 200);
    }

    // Memperbarui data TentangMhtqProfile berdasarkan ID
    public function update(Request $request, $id)
    {
        $tentangMhtqProfile = TentangMhtqProfile::find($id);

        if (!$tentangMhtqProfile) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $tentangMhtqProfile->update($request->all());

        return response()->json($tentangMhtqProfile, 200);
    }

    // Menghapus data TentangMhtqProfile berdasarkan ID
    public function destroy($id)
    {
        $tentangMhtqProfile = TentangMhtqProfile::find($id);

        if (!$tentangMhtqProfile) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tentangMhtqProfile->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
