<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramKesehatan;
use Illuminate\Http\Request;

class ApiProgramKesehatanController extends Controller
{
    // Menampilkan semua data ProgramKesehatan
    public function index()
    {
        $programKesehatan = ProgramKesehatan::all();
        return response()->json($programKesehatan, 200);
    }

    // Menyimpan data baru ProgramKesehatan
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programKesehatan = ProgramKesehatan::create($request->all());

        return response()->json($programKesehatan, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $programKesehatan = ProgramKesehatan::find($id);

        if (!$programKesehatan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($programKesehatan, 200);
    }

    // Memperbarui data ProgramKesehatan berdasarkan ID
    public function update(Request $request, $id)
    {
        $programKesehatan = ProgramKesehatan::find($id);

        if (!$programKesehatan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programKesehatan->update($request->all());

        return response()->json($programKesehatan, 200);
    }

    // Menghapus data ProgramKesehatan berdasarkan ID
    public function destroy($id)
    {
        $programKesehatan = ProgramKesehatan::find($id);

        if (!$programKesehatan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $programKesehatan->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
