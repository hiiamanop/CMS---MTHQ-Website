<?php

namespace App\Http\Controllers;

use App\Models\ProgramEkstrakurikuler;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramEkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programEkstrakurikulers = ProgramEkstrakurikuler::with('section')->paginate(10);
        return view('program_ekstrakurikuler.index', compact('programEkstrakurikulers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('program_ekstrakurikuler.create', compact('sections'));
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

        // Create the ProgramEkstrakurikuler record
        ProgramEkstrakurikuler::create($validatedData);

        // Redirect with success message
        return redirect()->route('program_ekstrakurikuler.index')->with('success', 'Program Ekstrakurikuler created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramEkstrakurikuler $programEkstrakurikuler)
    {
        return view('program_ekstrakurikuler.show', compact('programEkstrakurikuler'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramEkstrakurikuler $programEkstrakurikuler)
    {
        $sections = Section::all();
        return view('program_ekstrakurikuler.edit', compact('programEkstrakurikuler', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramEkstrakurikuler $programEkstrakurikuler)
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
            if ($programEkstrakurikuler->konten_gambar) {
                Storage::delete('public/' . $programEkstrakurikuler->konten_gambar);
            }
            // Store the new image
            $validatedData['konten_gambar'] = $request->file('konten_gambar')->store('konten_gambar', 'public');
        }

        // Update the record
        $programEkstrakurikuler->update($validatedData);

        // Redirect with success message
        return redirect()->route('program_ekstrakurikuler.index')->with('success', 'Program Ekstrakurikuler updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramEkstrakurikuler $programEkstrakurikuler)
    {
        if ($programEkstrakurikuler->konten_gambar) {
            Storage::delete($programEkstrakurikuler->konten_gambar);
        }

        $programEkstrakurikuler->delete();

        return redirect()->route('program_ekstrakurikuler.index')->with('success', 'Program Ekstrakurikuler deleted successfully.');
    }
}
