<?php

namespace App\Http\Controllers;

use App\Models\ProgramUbudiyah;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramUbudiyahController extends Controller
{
    // Menampilkan daftar ProgramUbudiyah
    public function index()
    {
        $programUbudiyahs = ProgramUbudiyah::with('section')->paginate(10);
        return view('program_ubudiyah.index', compact('programUbudiyahs'));
    }

    // Menampilkan form untuk membuat ProgramUbudiyah baru
    public function create()
    {
        $sections = Section::all();
        return view('program_ubudiyah.create', compact('sections'));
    }

    // Menyimpan data ProgramUbudiyah baru
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $programUbudiyah = new ProgramUbudiyah();
        $programUbudiyah->section_id = $request->section_id;
        $programUbudiyah->nama_attribute = $request->nama_attribute;
        $programUbudiyah->konten_teks = $request->konten_teks;

        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('program_ubudiyah_images', 'public');
            $programUbudiyah->konten_gambar = $imagePath;
        }

        $programUbudiyah->save();

        return redirect()->route('program_ubudiyah.index')->with('success', 'Program Ubudiyah created successfully.');
    }

    // Menampilkan form untuk mengedit ProgramUbudiyah
    public function edit($id)
    {
        $programUbudiyah = ProgramUbudiyah::findOrFail($id);
        $sections = Section::all();
        return view('program_ubudiyah.edit', compact('programUbudiyah', 'sections'));
    }

    // Memperbarui data ProgramUbudiyah
    public function update(Request $request, $id)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $programUbudiyah = ProgramUbudiyah::findOrFail($id);
        $programUbudiyah->section_id = $request->section_id;
        $programUbudiyah->nama_attribute = $request->nama_attribute;
        $programUbudiyah->tipe_konten = $request->tipe_konten;
        $programUbudiyah->konten_teks = $request->konten_teks;

        if ($request->hasFile('konten_gambar')) {
            // Hapus gambar lama jika ada
            if ($programUbudiyah->konten_gambar) {
                Storage::disk('public')->delete($programUbudiyah->konten_gambar);
            }

            $imagePath = $request->file('konten_gambar')->store('program_ubudiyah_images', 'public');
            $programUbudiyah->konten_gambar = $imagePath;
        }

        $programUbudiyah->save();

        return redirect()->route('program_ubudiyah.index')->with('success', 'Program Ubudiyah updated successfully.');
    }

    // Menghapus ProgramUbudiyah
    public function destroy($id)
    {
        $programUbudiyah = ProgramUbudiyah::findOrFail($id);

        // Hapus gambar jika ada
        if ($programUbudiyah->konten_gambar) {
            Storage::disk('public')->delete($programUbudiyah->konten_gambar);
        }

        $programUbudiyah->delete();

        return redirect()->route('program_ubudiyah.index')->with('success', 'Program Ubudiyah deleted successfully.');
    }
}
