<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiGaleriController extends Controller
{
    // Get all 'Galeri' with optional filter by 'jenis_galeri'
    public function index(Request $request)
    {
        $query = Galeri::with('section'); // Eager load the related 'section'

        // Check if a 'jenis_galeri' filter is provided and is valid
        if ($request->has('jenis_galeri') && in_array($request->jenis_galeri, Galeri::getJenisGaleriOptions())) {
            $query->where('jenis_galeri', $request->jenis_galeri);
        }

        // Optionally, you can filter by other fields (like section_id, etc.) as needed
        if ($request->has('section_id')) {
            $query->where('section_id', $request->section_id);
        }

        // Execute the query and return the results
        $galeris = $query->get();

        return response()->json($galeris);
    }

    // Get a specific 'Galeri' by ID
    public function show($id)
    {
        $galeri = Galeri::with('section')->find($id);

        if (!$galeri) {
            return response()->json(['message' => 'Galeri not found'], 404);
        }

        return response()->json($galeri);
    }

    // Store a new 'Galeri'
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'jenis_galeri' => 'required|in:' . implode(',', Galeri::getJenisGaleriOptions()), // Validate against allowed options
            'tipe_konten' => 'required|string',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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
            'jenis_galeri' => 'required|in:' . implode(',', Galeri::getJenisGaleriOptions()), // Validate against allowed options
            'tipe_konten' => 'required|string',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('galeri_images', 'public');
            $request->merge(['konten_gambar' => $imagePath]);
        }

        $galeri->update($request->all());

        return response()->json($galeri);
    }

    // Delete a 'Galeri'
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
