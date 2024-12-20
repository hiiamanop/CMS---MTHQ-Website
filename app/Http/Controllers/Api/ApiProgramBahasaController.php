<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramBahasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiProgramBahasaController extends Controller
{
    // Get all 'ProgramBahasa' with related 'Section'
    public function index()
    {
        $programBahasas = ProgramBahasa::with('section')->get();
        return response()->json($programBahasas);
    }

    // Get a specific 'ProgramBahasa' by ID
    public function show($id)
    {
        $programBahasa = ProgramBahasa::with('section')->find($id);

        if (!$programBahasa) {
            return response()->json(['message' => 'ProgramBahasa not found'], 404);
        }

        return response()->json($programBahasa);
    }

    // Create a new 'ProgramBahasa'
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'required|string',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If 'konten_gambar' is provided, store the image
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('program_bahasa_images', 'public');
            $request->merge(['konten_gambar' => $imagePath]);
        }

        $programBahasa = ProgramBahasa::create($request->all());

        return response()->json($programBahasa, 201);
    }

    // Update an existing 'ProgramBahasa'
    public function update(Request $request, $id)
    {
        $programBahasa = ProgramBahasa::find($id);

        if (!$programBahasa) {
            return response()->json(['message' => 'ProgramBahasa not found'], 404);
        }

        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'required|string',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If 'konten_gambar' is updated, store the new image
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('program_bahasa_images', 'public');
            $request->merge(['konten_gambar' => $imagePath]);
        }

        $programBahasa->update($request->all());

        return response()->json($programBahasa);
    }

    // Delete a 'ProgramBahasa'
    public function destroy($id)
    {
        $programBahasa = ProgramBahasa::find($id);

        if (!$programBahasa) {
            return response()->json(['message' => 'ProgramBahasa not found'], 404);
        }

        // Optionally delete the image from storage
        if ($programBahasa->konten_gambar) {
            Storage::disk('public')->delete($programBahasa->konten_gambar);
        }

        $programBahasa->delete();

        return response()->json(['message' => 'ProgramBahasa deleted successfully']);
    }
}
