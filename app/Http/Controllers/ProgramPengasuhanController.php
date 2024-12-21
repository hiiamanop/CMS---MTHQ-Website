<?php

namespace App\Http\Controllers;

use App\Models\ProgramPengasuhan;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramPengasuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all ProgramPengasuhan records and paginate the result
        $programPengasuhans = ProgramPengasuhan::paginate(10);
        return view('program_pengasuhan.index', compact('programPengasuhans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all sections for the dropdown menu
        $sections = Section::all();
        return view('program_pengasuhan.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'nullable|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload if present
        if ($request->hasFile('konten_gambar')) {
            $validatedData['konten_gambar'] = $request->file('konten_gambar')->store('konten_gambar', 'public');
        }

        // Create the ProgramPengasuhan record
        ProgramPengasuhan::create($validatedData);

        // Redirect with success message
        return redirect()->route('program_pengasuhan.index')->with('success', 'Program Pengasuhan created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramPengasuhan $programPengasuhan)
    {
        // Get all sections for the dropdown menu
        $sections = Section::all();
        return view('program_pengasuhan.edit', compact('programPengasuhan', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramPengasuhan $programPengasuhan)
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
            if ($programPengasuhan->konten_gambar) {
                Storage::delete('public/' . $programPengasuhan->konten_gambar);
            }
            $path = $request->file('konten_gambar')->store('images', 'public');
        }

        $programPengasuhan->update([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path ?? $programPengasuhan->konten_gambar,
        ]);

        return redirect()->route('program_pengasuhan.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramPengasuhan $programPengasuhan)
    {
        // Delete the image if exists
        if ($programPengasuhan->konten_gambar) {
            Storage::delete('public/konten_gambar/' . $programPengasuhan->konten_gambar);
        }

        // Delete the ProgramPengasuhan record
        $programPengasuhan->delete();

        // Redirect with success message
        return redirect()->route('program_pengasuhan.index')->with('success', 'Program Pengasuhan deleted successfully.');
    }
}
