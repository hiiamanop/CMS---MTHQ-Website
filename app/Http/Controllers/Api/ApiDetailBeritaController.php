<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiDetailBeritaController extends Controller
{
    // Get all 'DetailBerita' with their associated 'Section' and 'ListBerita'
    public function index()
    {
        $detailBeritas = DetailBerita::with(['section', 'listBerita'])->get();
        return response()->json($detailBeritas);
    }

    // Get a specific 'DetailBerita' by ID
    public function show($id)
    {
        $detailBerita = DetailBerita::with(['section', 'listBerita'])->find($id);

        if (!$detailBerita) {
            return response()->json(['message' => 'DetailBerita not found'], 404);
        }

        return response()->json($detailBerita);
    }

    // Create a new 'DetailBerita'
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'list_berita_id' => 'required|exists:list_beritas,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If konten_gambar is provided, store the image
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('berita_images', 'public');
            $request->merge(['konten_gambar' => $imagePath]);
        }

        $detailBerita = DetailBerita::create($request->all());

        return response()->json($detailBerita, 201);
    }

    // Update an existing 'DetailBerita'
    public function update(Request $request, $id)
    {
        $detailBerita = DetailBerita::find($id);

        if (!$detailBerita) {
            return response()->json(['message' => 'DetailBerita not found'], 404);
        }

        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'list_berita_id' => 'required|exists:list_beritas,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If konten_gambar is updated, store the new image
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('berita_images', 'public');
            $request->merge(['konten_gambar' => $imagePath]);
        }

        $detailBerita->update($request->all());

        return response()->json($detailBerita);
    }

    // Delete a specific 'DetailBerita'
    public function destroy($id)
    {
        $detailBerita = DetailBerita::find($id);

        if (!$detailBerita) {
            return response()->json(['message' => 'DetailBerita not found'], 404);
        }

        // Optionally delete the image from storage
        if ($detailBerita->konten_gambar) {
            Storage::disk('public')->delete($detailBerita->konten_gambar);
        }

        $detailBerita->delete();

        return response()->json(['message' => 'DetailBerita deleted successfully']);
    }
}
