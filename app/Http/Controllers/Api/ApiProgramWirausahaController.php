<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramWirausaha;
use Illuminate\Http\Request;

class ApiProgramWirausahaController extends Controller
{
    // Menampilkan semua data ProgramWirausaha
    public function index()
    {
        $programWirausaha = ProgramWirausaha::all();
        return response()->json($programWirausaha, 200);
    }

    // Menyimpan data baru ProgramWirausaha
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programWirausaha = ProgramWirausaha::create($request->all());

        return response()->json($programWirausaha, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $programWirausaha = ProgramWirausaha::find($id);

        if (!$programWirausaha) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($programWirausaha, 200);
    }

    // Memperbarui data ProgramWirausaha berdasarkan ID
    public function update(Request $request, $id)
    {
        $programWirausaha = ProgramWirausaha::find($id);

        if (!$programWirausaha) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programWirausaha->update($request->all());

        return response()->json($programWirausaha, 200);
    }

    // Menghapus data ProgramWirausaha berdasarkan ID
    public function destroy($id)
    {
        $programWirausaha = ProgramWirausaha::find($id);

        if (!$programWirausaha) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $programWirausaha->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
