<?php

namespace App\Http\Controllers;

use App\Models\ProgramWirausaha;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramWirausahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programWirausahas = ProgramWirausaha::with('section')->paginate(10);
        return view('program_wirausaha.index', compact('programWirausahas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('program_wirausaha.create', compact('sections'));
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

        // Create the ProgramTahfidz record
        ProgramWirausaha::create($validatedData);

        // Redirect with success message
        return redirect()->route('program_wirausaha.index')->with('success', 'Program Tahfidz created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(ProgramWirausaha $programWirausaha)
    {
        return view('program_wirausaha.show', compact('programWirausaha'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramWirausaha $programWirausaha)
    {
        $sections = Section::all();
        return view('program_wirausaha.edit', compact('programWirausaha', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramWirausaha $programWirausaha)
{
    // Validate request data
    $validatedData = $request->validate([
        'section_id' => 'nullable|exists:sections,id',
        'nama_attribute' => 'required|string|max:255',
        'tipe_konten' => 'nullable|in:teks,gambar',
        'konten_teks' => 'nullable|string',
        'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle image upload if exists
    if ($request->hasFile('konten_gambar')) {
        // Delete old image if exists
        if ($programWirausaha->konten_gambar) {
            Storage::delete('public/' . $programWirausaha->konten_gambar);
        }
        // Store the new image
        $validatedData['konten_gambar'] = $request->file('konten_gambar')->store('konten_gambar', 'public');
    }

    // Update the record
    $programWirausaha->update($validatedData);

    // Redirect with success message
    return redirect()->route('program_wirausaha.index')->with('success', 'Program Tahfidz updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramWirausaha $programWirausaha)
    {
        if ($programWirausaha->konten_gambar) {
            Storage::delete($programWirausaha->konten_gambar);
        }

        $programWirausaha->delete();

        return redirect()->route('program_wirausaha.index')->with('success', 'Program wirausaha berhasil dihapus.');
    }
}
