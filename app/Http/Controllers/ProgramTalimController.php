<?php

namespace App\Http\Controllers;

use App\Models\ProgramTalim;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramTalimController extends Controller
{
    // Menampilkan daftar ProgramTalim
    public function index()
    {
        $programTalims = ProgramTalim::with('section')->paginate(10);
        return view('program_talim.index', compact('programTalims'));
    }

    // Menampilkan form untuk membuat ProgramTalim baru
    public function create()
    {
        $programTalimSections = Section::all(); // Mengambil semua section
        return view('program_talim.create', compact('programTalimSections'));
    }

    // Menyimpan ProgramTalim baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Menyimpan ProgramTalim
        $data = $request->only(['section_id', 'nama_attribute', 'tipe_konten', 'konten_teks']);

        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('konten_images', 'public');
            $data['konten_gambar'] = $imagePath;
        }

        ProgramTalim::create($data);

        return redirect()->route('program_talim.index')->with('success', 'ProgramTalim berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit ProgramTalim
    public function edit($id)
    {
        $programTahfidz = ProgramTalim::findOrFail($id);
        $programTahfidzSections = Section::all(); // Atau sesuai dengan query yang Anda gunakan untuk mendapatkan sections

        return view('program_talim.edit', compact('programTahfidz', 'programTahfidzSections'));
    }


    // Memperbarui data ProgramTalim
    public function update(Request $request, ProgramTalim $programTalim)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'required|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mengupdate ProgramTalim
        $data = $request->only(['section_id', 'nama_attribute', 'tipe_konten', 'konten_teks']);

        if ($request->hasFile('konten_gambar')) {
            // Menghapus gambar lama jika ada
            if ($programTalim->konten_gambar) {
                Storage::disk('public')->delete($programTalim->konten_gambar);
            }
            $imagePath = $request->file('konten_gambar')->store('konten_images', 'public');
            $data['konten_gambar'] = $imagePath;
        }

        $programTalim->update($data);

        return redirect()->route('program_talim.index')->with('success', 'ProgramTalim berhasil diperbarui.');
    }

    // Menghapus ProgramTalim
    public function destroy(ProgramTalim $programTalim)
    {
        // Menghapus gambar jika ada
        if ($programTalim->konten_gambar) {
            Storage::disk('public')->delete($programTalim->konten_gambar);
        }

        $programTalim->delete();

        return redirect()->route('program_talim.index')->with('success', 'ProgramTalim berhasil dihapus.');
    }
}
