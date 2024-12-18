<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeamanan;
use Illuminate\Http\Request;

class ApiProgramKeamananController extends Controller
{
    // Menampilkan semua data ProgramKeamanan
    public function index()
    {
        $programKeamanan = ProgramKeamanan::all();
        return response()->json($programKeamanan, 200);
    }

    // Menyimpan data baru ProgramKeamanan
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programKeamanan = ProgramKeamanan::create($request->all());

        return response()->json($programKeamanan, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $programKeamanan = ProgramKeamanan::find($id);

        if (!$programKeamanan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($programKeamanan, 200);
    }

    // Memperbarui data ProgramKeamanan berdasarkan ID
    public function update(Request $request, $id)
    {
        $programKeamanan = ProgramKeamanan::find($id);

        if (!$programKeamanan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programKeamanan->update($request->all());

        return response()->json($programKeamanan, 200);
    }

    // Menghapus data ProgramKeamanan berdasarkan ID
    public function destroy($id)
    {
        $programKeamanan = ProgramKeamanan::find($id);

        if (!$programKeamanan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $programKeamanan->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
