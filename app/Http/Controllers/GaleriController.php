<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Section;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Menampilkan daftar galeri.
     */
    public function index()
    {
        // Ambil semua data galeri dengan relasi section
        $galeris = Galeri::with('section')->paginate(10);

        return view('galeri.index', compact('galeris'));
    }

    /**
     * Menampilkan form untuk membuat galeri baru.
     */
    public function create()
    {
        $sections = Section::all(); // Ambil semua data sections
        $jenisGaleriOptions = Galeri::getJenisGaleriOptions();

        return view('galeri.create', compact('sections', 'jenisGaleriOptions'));
    }

    /**
     * Menyimpan data galeri baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'jenis_galeri' => 'required|string|in:' . implode(',', Galeri::getJenisGaleriOptions()),
            'tipe_konten' => 'required|string|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menangani upload gambar jika ada
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('uploads/galeri', 'public');
            $validated['konten_gambar'] = $imagePath;
        }

        // Simpan data ke database
        Galeri::create($validated);

        return redirect()->route('galeris.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk edit data galeri.
     */
    public function edit(Galeri $galeri)
    {
        $sections = Section::all(); // Ambil semua data sections
        $jenisGaleriOptions = Galeri::getJenisGaleriOptions();

        return view('galeri.edit', compact('galeri', 'sections', 'jenisGaleriOptions'));
    }

    /**
     * Memperbarui data galeri di database.
     */
    public function update(Request $request, Galeri $galeri)
    {
        // Validasi input
        $validated = $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'jenis_galeri' => 'required|string|in:' . implode(',', Galeri::getJenisGaleriOptions()),
            'tipe_konten' => 'required|string|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menangani upload gambar jika ada
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('uploads/galeri', 'public');
            $validated['konten_gambar'] = $imagePath;
        }

        // Update data di database
        $galeri->update($validated);

        return redirect()->route('galeris.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Menghapus data galeri dari database.
     */
    public function destroy(Galeri $galeri)
    {
        // Hapus data
        $galeri->delete();

        return redirect()->route('galeris.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
