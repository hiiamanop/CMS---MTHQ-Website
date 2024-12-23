<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KalenderAkademikController extends Controller
{
    // Show all kalender akademik records
    public function index()
    {
        $kalenderAkademiks = KalenderAkademik::with('section')->paginate(10); // Fetch all records with related section data
        return view('kalender_akademik.index', compact('kalenderAkademiks'));
    }

    // Show form to create a new kalender akademik
    public function create()
    {
        $sections = Section::all(); // Fetch all sections
        return view('kalender_akademik.create', compact('sections'));
    }

    // Store a newly created kalender akademik in storage
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf', // Menambahkan PDF ke validasi
        ]);

        // Handle file upload if there is a file
        if ($request->hasFile('konten_gambar')) {
            $path = $request->file('konten_gambar')->store('konten_gambar', 'public');
        }

        KalenderAkademik::create([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $path ?? null, // Store the image path if available
        ]);

        return redirect()->route('kalender_akademiks.index')->with('success', 'Kalender Akademik created successfully!');
    }

    // Show the form for editing the specified kalender akademik
    public function edit(KalenderAkademik $kalenderAkademik)
    {
        $sections = Section::all(); // Fetch all sections
        return view('kalender_akademik.edit', compact('kalenderAkademik', 'sections'));
    }

    // Update the specified kalender akademik in storageZ
    public function update(Request $request, KalenderAkademik $kalenderAkademik)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf', // Menambahkan PDF ke validasi
        ]);
        

        // Handle file upload if there is a new file
        if ($request->hasFile('konten_gambar')) {
            $path = $request->file('konten_gambar')->store('konten_gambar', 'public');
            $kalenderAkademik->konten_gambar = $path; // Update image path
        }

        $kalenderAkademik->update([
            'section_id' => $request->section_id,
            'nama_attribute' => $request->nama_attribute,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            // 'konten_gambar' is updated only if a new image is uploaded
        ]);

        return redirect()->route('kalender_akademiks.index')->with('success', 'Kalender Akademik updated successfully!');
    }

    // Remove the specified kalender akademik from storage
    public function destroy(KalenderAkademik $kalenderAkademik)
    {
        if ($kalenderAkademik->konten_gambar) {
            Storage::delete($kalenderAkademik->konten_gambar); // Delete image file from storage if it exists
        }

        $kalenderAkademik->delete();
        return redirect()->route('kalender_akademiks.index')->with('success', 'Kalender Akademik deleted successfully!');
    }
}
