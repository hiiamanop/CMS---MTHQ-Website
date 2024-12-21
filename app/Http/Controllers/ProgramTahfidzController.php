<?php

namespace App\Http\Controllers;

use App\Models\ProgramTahfidz;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramTahfidzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programTahfidzs = ProgramTahfidz::with('section')->paginate(10);
        return view('program_tahfidz.index', compact('programTahfidzs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programTahfidzSections = Section::all(); // Ambil data sections
        return view('program_tahfidz.create', compact('programTahfidzSections'));
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
        ProgramTahfidz::create($validatedData);

        // Redirect with success message
        return redirect()->route('program_tahfidz.index')->with('success', 'Program Tahfidz created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programTahfidz = ProgramTahfidz::findOrFail($id);
        $programTahfidzSections = Section::all(); // Ambil semua Section
        return view('program_tahfidz.edit', compact('programTahfidz', 'programTahfidzSections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramTahfidz $programTahfidz)
    {
        // Validate request data
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'nullable|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload if exists
        if ($request->hasFile('konten_gambar')) {
            // Delete old image if exists
            if ($programTahfidz->konten_gambar) {
                Storage::delete('public/' . $programTahfidz->konten_gambar);
            }
            $path = $request->file('konten_gambar')->store('konten_gambar', 'public');
        }

        // Update the record
        $programTahfidz->update([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path ?? $programTahfidz->konten_gambar,
        ]);

        // Redirect with success message
        return redirect()->route('program_tahfidz.index')->with('success', 'Program Tahfidz updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramTahfidz $programTahfidz)
    {
        // Delete image if exists
        if ($programTahfidz->konten_gambar) {
            Storage::delete('public/' . $programTahfidz->konten_gambar);
        }

        $programTahfidz->delete();

        return redirect()->route('program_tahfidz.index')->with('success', 'Program Tahfidz deleted successfully.');
    }
}
