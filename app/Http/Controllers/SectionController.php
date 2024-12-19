<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Menampilkan semua data sections.
     */
    public function index()
    {
        $sections = Section::paginate(10);
        return view('sections.index', compact('sections'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        // Jika menggunakan view
        return view('sections.create');
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        $section = Section::create($validatedData);

        return redirect()->route('sections.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data berdasarkan ID.
     */
    public function show(Section $section)
    {
        return response()->json($section);
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(Section $section)
    {
        // Jika menggunakan view
        return view('sections.edit', compact('section'));
    }

    /**
     * Mengupdate data yang ada berdasarkan ID.
     */
    public function update(Request $request, Section $section)
    {
        $validatedData = $request->validate([
            'item' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        $section->update($validatedData);

        return redirect()->route('sections.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Menghapus data berdasarkan ID.
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Data berhasil dihapus.');
    }
}
