<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiGaleriController extends Controller
{
    // Fetch all 'Galeri' with its associated 'Section'
    public function index()
    {
        $galeris = Galeri::with('section')->get();
        return response()->json($galeris);
    }

    // Fetch a specific 'Galeri' by its ID
    public function show($id)
    {
        $galeri = Galeri::with('section')->find($id);

        if (!$galeri) {
            return response()->json(['message' => 'Galeri not found'], 404);
        }

        return response()->json($galeri);
    }

    // Create a new 'Galeri'
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'jenis_galeri' => 'required|in:' . implode(',', Galeri::getJenisGaleriOptions()),
            'tipe_konten' => 'required|string|max:255',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If konten_gambar is provided, store the image
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('galeri_images', 'public');
            $request->merge(['konten_gambar' => $imagePath]);
        }

        $galeri = Galeri::create($request->all());

        return response()->json($galeri, 201);
    }

    // Update an existing 'Galeri'
    public function update(Request $request, $id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return response()->json(['message' => 'Galeri not found'], 404);
        }

        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'jenis_galeri' => 'required|in:' . implode(',', Galeri::getJenisGaleriOptions()),
            'tipe_konten' => 'required|string|max:255',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If konten_gambar is updated, store the new image
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('galeri_images', 'public');
            $request->merge(['konten_gambar' => $imagePath]);
        }

        $galeri->update($request->all());

        return response()->json($galeri);
    }

    // Delete a specific 'Galeri'
    public function destroy($id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return response()->json(['message' => 'Galeri not found'], 404);
        }

        // Optionally delete the image from storage
        if ($galeri->konten_gambar) {
            Storage::disk('public')->delete($galeri->konten_gambar);
        }

        $galeri->delete();

        return response()->json(['message' => 'Galeri deleted successfully']);
    }
}
