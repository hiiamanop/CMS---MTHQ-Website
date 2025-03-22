<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Beranda;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiBerandaController extends Controller
{
    // Fetch all beranda
    public function index()
    {
        $berandas = Beranda::with('section')->get();
        return response()->json($berandas);
    }

    public function testimoni()
    {
        $testimoni = Beranda::with('section')
            ->whereHas('section', function ($query) {
                $query->where('section', 'Testimoni - Beranda');
            })
            ->get();

        return response()->json($testimoni);
    }

    public function JumlahBeranda()
    {
        $jumlah = Beranda::with('section')
            ->whereHas('section', function ($query) {
                $query->where('section', 'Jumlah - Beranda');
            })
            ->get();

        return response()->json($jumlah);
    }

    public function PendaftaranSantriBaru()
    {
        $pendaftaran = Beranda::with('section')
            ->whereHas('section', function ($query) {
                $query->where('section', 'Pendaftaran santri baru - Beranda');
            })
            ->get();

        return response()->json($pendaftaran);
    }

    // Show a specific beranda by id
    public function show($id)
    {
        $beranda = Beranda::with('section')->find($id);

        if (!$beranda) {
            return response()->json(['message' => 'Beranda not found'], 404);
        }

        return response()->json($beranda);
    }

    // Create a new beranda
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'required|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|max:2048',
        ]);

        $path = null;
        // Handle image upload if exists
        if ($request->hasFile('konten_gambar')) {
            $path = $request->file('konten_gambar')->store('images', 'public');
        }

        $beranda = Beranda::create([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path,
        ]);

        return response()->json($beranda, 201);
    }

    // Update a specific beranda
    public function update(Request $request, $id)
    {
        $beranda = Beranda::find($id);

        if (!$beranda) {
            return response()->json(['message' => 'Beranda not found'], 404);
        }

        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'required|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|max:2048',
        ]);

        $path = $beranda->konten_gambar; // Retain the existing image path

        // Handle image upload if exists
        if ($request->hasFile('konten_gambar')) {
            // Delete old image if exists
            if ($beranda->konten_gambar) {
                Storage::delete('public/' . $beranda->konten_gambar);
            }
            $path = $request->file('konten_gambar')->store('images', 'public');
        }

        $beranda->update([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path,
        ]);

        return response()->json($beranda);
    }

    // Delete a specific beranda
    public function destroy($id)
    {
        $beranda = Beranda::find($id);

        if (!$beranda) {
            return response()->json(['message' => 'Beranda not found'], 404);
        }

        // Delete image if exists
        if ($beranda->konten_gambar) {
            Storage::delete('public/' . $beranda->konten_gambar);
        }

        $beranda->delete();
        return response()->json(['message' => 'Beranda deleted successfully']);
    }
}
