<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramUbudiyah;
use Illuminate\Http\Request;

class ApiProgramUbudiyahController extends Controller
{
    // Menampilkan semua data ProgramUbudiyah
    public function index()
    {
        $programUbudiyah = ProgramUbudiyah::all();
        return response()->json($programUbudiyah, 200);
    }

    // Menyimpan data baru ProgramUbudiyah
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programUbudiyah = ProgramUbudiyah::create($request->all());

        return response()->json($programUbudiyah, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $programUbudiyah = ProgramUbudiyah::find($id);

        if (!$programUbudiyah) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($programUbudiyah, 200);
    }

    // Memperbarui data ProgramUbudiyah berdasarkan ID
    public function update(Request $request, $id)
    {
        $programUbudiyah = ProgramUbudiyah::find($id);

        if (!$programUbudiyah) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programUbudiyah->update($request->all());

        return response()->json($programUbudiyah, 200);
    }

    // Menghapus data ProgramUbudiyah berdasarkan ID
    public function destroy($id)
    {
        $programUbudiyah = ProgramUbudiyah::find($id);

        if (!$programUbudiyah) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $programUbudiyah->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
