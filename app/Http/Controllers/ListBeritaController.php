<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ListBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiListBeritaController extends Controller
{
    // Fetch all 'ListBerita' with its associated 'Section'
    public function index()
    {
        $listBeritas = ListBerita::with('section')->get();
        return response()->json($listBeritas);
    }

    // Fetch a specific 'ListBerita' by its ID
    public function show($id)
    {
        $listBerita = ListBerita::with('section')->find($id);

        if (!$listBerita) {
            return response()->json(['message' => 'ListBerita not found'], 404);
        }

        return response()->json($listBerita);
    }

    // Create a new 'ListBerita'
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'kategori_berita' => 'required|string|max:255',
            'judul_berita' => 'required|string|max:255',
            'tanggal_upload' => 'required|date',
            'highlight_berita' => 'required|string|max:500',
            'tipe_konten' => 'required|string|max:255',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If konten_gambar is provided, store the image
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('berita_images', 'public');
            $request->merge(['konten_gambar' => $imagePath]);
        }

        $listBerita = ListBerita::create($request->all());

        return response()->json($listBerita, 201);
    }

    // Update an existing 'ListBerita'
    public function update(Request $request, $id)
    {
        $listBerita = ListBerita::find($id);

        if (!$listBerita) {
            return response()->json(['message' => 'ListBerita not found'], 404);
        }

        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'kategori_berita' => 'required|string|max:255',
            'judul_berita' => 'required|string|max:255',
            'tanggal_upload' => 'required|date',
            'highlight_berita' => 'required|string|max:500',
            'tipe_konten' => 'required|string|max:255',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If konten_gambar is updated, store the new image
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('berita_images', 'public');
            $request->merge(['konten_gambar' => $imagePath]);
        }

        $listBerita->update($request->all());

        return response()->json($listBerita);
    }

    // Delete a specific 'ListBerita'
    public function destroy($id)
    {
        $listBerita = ListBerita::find($id);

        if (!$listBerita) {
            return response()->json(['message' => 'ListBerita not found'], 404);
        }

        // Optionally delete the image from storage
        if ($listBerita->konten_gambar) {
            Storage::disk('public')->delete($listBerita->konten_gambar);
        }

        $listBerita->delete();

        return response()->json(['message' => 'ListBerita deleted successfully']);
    }
}
