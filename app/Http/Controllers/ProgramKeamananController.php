<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeamanan;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramKeamananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programKeamanans = ProgramKeamanan::with('section')->latest()->paginate(10);
        return view('program_keamanan.index', compact('programKeamanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('program_keamanan.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'nullable|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('konten_gambar')) {
            $validatedData['konten_gambar'] = $request->file('konten_gambar')->store('konten_gambar', 'public');
;
        }

        ProgramKeamanan::create($validatedData);

        return redirect()->route('program_keamanan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramKeamanan $programKeamanan)
    {
        $sections = Section::all();
        return view('program_keamanan.edit', compact('programKeamanan', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramKeamanan $programKeamanan)
    {
        $validatedData = $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'nullable|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('konten_gambar')) {
            // Hapus gambar lama jika ada
            if ($programKeamanan->konten_gambar) {
                Storage::delete($programKeamanan->konten_gambar);
            }
            $validatedData['konten_gambar'] = $request->file('konten_gambar')->store('konten_gambar', 'public');
        }

        $programKeamanan->update($validatedData);

        return redirect()->route('program_keamanan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramKeamanan $programKeamanan)
    {
        // Hapus gambar jika ada
        if ($programKeamanan->konten_gambar) {
            Storage::delete($programKeamanan->konten_gambar);
        }

        $programKeamanan->delete();

        return redirect()->route('program_keamanan.index')->with('success', 'Data berhasil dihapus.');
    }
}
