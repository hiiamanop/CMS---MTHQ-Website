<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramBahasa;
use Illuminate\Http\Request;

class ApiProgramBahasaController extends Controller
{
    // Menampilkan semua data ProgramBahasa
    public function index()
    {
        $programBahasa = ProgramBahasa::all();
        return response()->json($programBahasa, 200);
    }

    // Menyimpan data baru ProgramBahasa
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programBahasa = ProgramBahasa::create($request->all());

        return response()->json($programBahasa, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $programBahasa = ProgramBahasa::find($id);

        if (!$programBahasa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($programBahasa, 200);
    }

    // Memperbarui data ProgramBahasa berdasarkan ID
    public function update(Request $request, $id)
    {
        $programBahasa = ProgramBahasa::find($id);

        if (!$programBahasa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programBahasa->update($request->all());

        return response()->json($programBahasa, 200);
    }

    // Menghapus data ProgramBahasa berdasarkan ID
    public function destroy($id)
    {
        $programBahasa = ProgramBahasa::find($id);

        if (!$programBahasa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $programBahasa->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
