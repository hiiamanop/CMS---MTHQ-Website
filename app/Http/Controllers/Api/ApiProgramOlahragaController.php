<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramOlahraga;
use Illuminate\Http\Request;

class ApiProgramOlahragaController extends Controller
{
    // Menampilkan semua data ProgramOlahraga
    public function index()
    {
        $programOlahraga = ProgramOlahraga::all();
        return response()->json($programOlahraga, 200);
    }

    // Menyimpan data baru ProgramOlahraga
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programOlahraga = ProgramOlahraga::create($request->all());

        return response()->json($programOlahraga, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $programOlahraga = ProgramOlahraga::find($id);

        if (!$programOlahraga) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($programOlahraga, 200);
    }

    // Memperbarui data ProgramOlahraga berdasarkan ID
    public function update(Request $request, $id)
    {
        $programOlahraga = ProgramOlahraga::find($id);

        if (!$programOlahraga) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programOlahraga->update($request->all());

        return response()->json($programOlahraga, 200);
    }

    // Menghapus data ProgramOlahraga berdasarkan ID
    public function destroy($id)
    {
        $programOlahraga = ProgramOlahraga::find($id);

        if (!$programOlahraga) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $programOlahraga->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
