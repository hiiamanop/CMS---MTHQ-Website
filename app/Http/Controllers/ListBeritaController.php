<?php

namespace App\Http\Controllers;

use App\Models\ListBerita;
use App\Models\Section;
use Illuminate\Http\Request;

class ListBeritaController extends Controller
{
    /**
     * Menampilkan daftar berita.
     */
    public function index()
    {
        // Ambil semua data berita dengan relasi section
        $beritas = ListBerita::with('section')->paginate(10);

        return view('listberita.index', compact('beritas'));
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        $sections = Section::all(); // Ambil semua data sections
        $kategoriBeritaOptions = ListBerita::getKategoriBeritaOptions();

        return view('listberita.create', compact('sections', 'kategoriBeritaOptions'));
    }

    /**
     * Menyimpan data berita baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'judul_berita' => 'required|string|max:255',
            'kategori_berita' => 'required|in:artikel,berita',  // This ensures the value must be either 'artikel' or 'berita'
            'tanggal_upload' => 'required|date',
            'highlight_berita' => 'nullable|string',
            'tipe_konten' => 'required|string|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Menangani upload gambar jika ada
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('uploads/berita', 'public');
            $validated['konten_gambar'] = $imagePath;
        }

        // Simpan data ke database
        ListBerita::create($validated);

        return redirect()->route('list-beritas.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk edit data berita.
     */
    public function edit(ListBerita $listBerita)
    {
        $sections = Section::all(); // Ambil semua data sections
        $kategoriBeritaOptions = ListBerita::getKategoriBeritaOptions();

        return view('listberita.edit', compact('listBerita', 'sections', 'kategoriBeritaOptions'));
    }

    /**
     * Memperbarui data berita di database.
     */
    public function update(Request $request, ListBerita $listBerita)
    {
        // Validasi input
        $validated = $request->validate([
            'judul_berita' => 'required|string|max:255',
            'kategori_berita' => 'required|in:artikel,berita',  // This ensures the value must be either 'artikel' or 'berita'
            'tanggal_upload' => 'required|date',
            'highlight_berita' => 'nullable|string',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Menangani upload gambar jika ada
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('uploads/berita', 'public');
            $validated['konten_gambar'] = $imagePath; // Assign the image path to the validated data
        }

        // Update data di database
        $listBerita->update($validated);

        return redirect()->route('list-beritas.index')->with('success', 'Berita berhasil diperbarui.');
    }


    /**
     * Menghapus data berita dari database.
     */
    public function destroy(ListBerita $listBerita)
    {
        // Hapus data
        $listBerita->delete();

        return redirect()->route('list-beritas.index')->with('success', 'Berita berhasil dihapus.');
    }
}
