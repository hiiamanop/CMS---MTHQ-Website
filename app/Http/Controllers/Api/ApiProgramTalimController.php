<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramTalim;
use Illuminate\Http\Request;

class ApiProgramTalimController extends Controller
{
    // Menampilkan semua data ProgramTalim
    public function index()
    {
        $programTalim = ProgramTalim::all();
        return response()->json($programTalim, 200);
    }

    // Menyimpan data baru ProgramTalim
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programTalim = ProgramTalim::create($request->all());

        return response()->json($programTalim, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $programTalim = ProgramTalim::find($id);

        if (!$programTalim) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($programTalim, 200);
    }

    // Memperbarui data ProgramTalim berdasarkan ID
    public function update(Request $request, $id)
    {
        $programTalim = ProgramTalim::find($id);

        if (!$programTalim) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programTalim->update($request->all());

        return response()->json($programTalim, 200);
    }

    // Menghapus data ProgramTalim berdasarkan ID
    public function destroy($id)
    {
        $programTalim = ProgramTalim::find($id);

        if (!$programTalim) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $programTalim->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
