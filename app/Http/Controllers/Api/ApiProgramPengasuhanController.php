<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramPengasuhan;
use Illuminate\Http\Request;

class ApiProgramPengasuhanController extends Controller
{
    // Menampilkan semua data ProgramPengasuhan
    public function index()
    {
        $programPengasuhan = ProgramPengasuhan::all();
        return response()->json($programPengasuhan, 200);
    }

    // Menyimpan data baru ProgramPengasuhan
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programPengasuhan = ProgramPengasuhan::create($request->all());

        return response()->json($programPengasuhan, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $programPengasuhan = ProgramPengasuhan::find($id);

        if (!$programPengasuhan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($programPengasuhan, 200);
    }

    // Memperbarui data ProgramPengasuhan berdasarkan ID
    public function update(Request $request, $id)
    {
        $programPengasuhan = ProgramPengasuhan::find($id);

        if (!$programPengasuhan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programPengasuhan->update($request->all());

        return response()->json($programPengasuhan, 200);
    }

    // Menghapus data ProgramPengasuhan berdasarkan ID
    public function destroy($id)
    {
        $programPengasuhan = ProgramPengasuhan::find($id);

        if (!$programPengasuhan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $programPengasuhan->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
