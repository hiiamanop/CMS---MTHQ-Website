<?php

namespace App\Http\Controllers;

use App\Models\ProgramKesehatan;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programKesehatans = ProgramKesehatan::paginate(10);
        return view('program_kesehatans.index', compact('programKesehatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('program_kesehatans.create', compact('sections'));
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
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload if present
        if ($request->hasFile('konten_gambar')) {
            $validatedData['konten_gambar'] = $request->file('konten_gambar')->store('konten_gambar', 'public');
        }

        // Create a new ProgramKesehatan record
        ProgramKesehatan::create($validatedData);

        // Redirect with success message
        return redirect()->route('program_kesehatans.index')->with('success', 'Program Kesehatan created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramKesehatan $programKesehatan)
    {
        $sections = Section::all();
        return view('program_kesehatans.edit', compact('programKesehatan', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramKesehatan $programKesehatan)
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
            if ($programKesehatan->konten_gambar) {
                Storage::delete('public/' . $programKesehatan->konten_gambar);
            }
            $path = $request->file('konten_gambar')->store('images', 'public');
        }

        $programKesehatan->update([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path ?? $programKesehatan->konten_gambar,
        ]);

        return redirect()->route('program_kesehatans.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramKesehatan $programKesehatan)
    {
        if ($programKesehatan->konten_gambar) {
            Storage::delete('public/program_kesehatan_images/' . $programKesehatan->konten_gambar);
        }

        $programKesehatan->delete();

        return redirect()->route('program_kesehatans.index')->with('success', 'Program Kesehatan deleted successfully.');
    }
}
