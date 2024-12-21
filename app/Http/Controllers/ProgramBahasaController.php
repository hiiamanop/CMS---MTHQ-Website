<?php

namespace App\Http\Controllers;

use App\Models\ProgramBahasa;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramBahasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programBahasas = ProgramBahasa::with('section')->paginate(10);
        return view('program_bahasas.index', compact('programBahasas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('program_bahasas.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'nullable|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|max:2048',
        ]);

        // Handle image upload if exists
        if ($request->hasFile('konten_gambar')) {
            $path = $request->file('konten_gambar')->store('images', 'public');
        }

        ProgramBahasa::create([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path ?? null,
        ]);

        return redirect()->route('program_bahasas.index')->with('success', 'Program Bahasa created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramBahasa $programBahasa)
    {
        $sections = Section::all();
        return view('program_bahasas.edit', compact('programBahasa', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramBahasa $programBahasa)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'nullable|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|max:2048',
        ]);

        // Handle image upload if exists
        if ($request->hasFile('konten_gambar')) {
            // Delete old image if exists
            if ($programBahasa->konten_gambar) {
                Storage::delete('public/' . $programBahasa->konten_gambar);
            }
            $path = $request->file('konten_gambar')->store('images', 'public');
        }

        $programBahasa->update([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path ?? $programBahasa->konten_gambar,
        ]);

        return redirect()->route('program_bahasas.index')->with('success', 'Program Bahasa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramBahasa $programBahasa)
    {
        // Delete image if exists
        if ($programBahasa->konten_gambar) {
            Storage::delete('public/' . $programBahasa->konten_gambar);
        }

        $programBahasa->delete();

        return redirect()->route('program_bahasas.index')->with('success', 'Program Bahasa deleted successfully.');
    }
}
