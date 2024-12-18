<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramTahfidz;
use Illuminate\Http\Request;

class ApiProgramTahfidzController extends Controller
{
    // Menampilkan semua data ProgramTahfidz
    public function index()
    {
        $programTahfidz = ProgramTahfidz::all();
        return response()->json($programTahfidz, 200);
    }

    // Menyimpan data baru ProgramTahfidz
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programTahfidz = ProgramTahfidz::create($request->all());

        return response()->json($programTahfidz, 201);
    }

    // Menampilkan data spesifik berdasarkan ID
    public function show($id)
    {
        $programTahfidz = ProgramTahfidz::find($id);

        if (!$programTahfidz) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($programTahfidz, 200);
    }

    // Memperbarui data ProgramTahfidz berdasarkan ID
    public function update(Request $request, $id)
    {
        $programTahfidz = ProgramTahfidz::find($id);

        if (!$programTahfidz) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_attribute' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $programTahfidz->update($request->all());

        return response()->json($programTahfidz, 200);
    }

    // Menghapus data ProgramTahfidz berdasarkan ID
    public function destroy($id)
    {
        $programTahfidz = ProgramTahfidz::find($id);

        if (!$programTahfidz) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $programTahfidz->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
