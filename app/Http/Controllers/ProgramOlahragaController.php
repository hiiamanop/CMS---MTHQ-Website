<?php

namespace App\Http\Controllers;

use App\Models\ProgramOlahraga;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramOlahragaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programOlahragas = ProgramOlahraga::paginate(10);
        return view('program_olahraga.index', compact('programOlahragas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('program_olahraga.create', compact('sections'));
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

        ProgramOlahraga::create([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path ?? null,
        ]);

        return redirect()->route('program_olahraga.index')->with('success', 'Item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramOlahraga $programOlahraga)
    {
        $sections = Section::all();
        return view('program_olahraga.edit', compact('programOlahraga', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramOlahraga $programOlahraga)
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
            if ($programOlahraga->konten_gambar) {
                Storage::delete('public/' . $programOlahraga->konten_gambar);
            }
            $path = $request->file('konten_gambar')->store('images', 'public');
        }

        $programOlahraga->update([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path ?? $programOlahraga->konten_gambar,
        ]);

        return redirect()->route('program_olahraga.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramOlahraga $programOlahraga)
    {
        if ($programOlahraga->konten_gambar) {
            Storage::delete('public/konten_gambar/' . $programOlahraga->konten_gambar);
        }

        $programOlahraga->delete();

        return redirect()->route('program_olahraga.index')->with('success', 'Program Olahraga deleted successfully.');
    }
}
