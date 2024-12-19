<?php

namespace App\Http\Controllers;

use App\Models\DetailBerita;
use App\Models\ListBerita;
use App\Models\Section;
use Illuminate\Http\Request;

class DetailBeritaController extends Controller
{
    /**
     * Menampilkan daftar detail berita.
     */
    public function index()
    {
        // Ambil semua data detail berita dengan relasi yang diperlukan
        $detailBeritas = DetailBerita::with(['listBerita', 'section'])->paginate(10);

        return view('detailberita.index', compact('detailBeritas'));
    }

    /**
     * Menampilkan form untuk membuat detail berita baru.
     */
    public function create()
    {
        $sections = Section::all(); // Ambil semua data sections
        $listBeritas = ListBerita::all(); // Ambil semua data list_beritas

        return view('detailberita.create', compact('sections', 'listBeritas'));
    }

    /**
     * Menyimpan data detail berita baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'list_berita_id' => 'required|exists:list_beritas,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tipe_konten' => 'required|string|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Menangani upload gambar jika ada
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('uploads/detail_berita', 'public');
            $validated['konten_gambar'] = $imagePath;
        }

        // Simpan data ke database
        DetailBerita::create($validated);

        return redirect()->route('detail-beritas.index')->with('success', 'Detail Berita berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk edit data detail berita.
     */
    public function edit(DetailBerita $detailBerita)
    {
        $sections = Section::all(); // Ambil semua data sections
        $listBeritas = ListBerita::all(); // Ambil semua data list_beritas

        return view('detailberita.edit', compact('detailBerita', 'sections', 'listBeritas'));
    }

    /**
     * Memperbarui data detail berita di database.
     */
    public function update(Request $request, DetailBerita $detailBerita)
    {
        // Validasi input
        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'list_berita_id' => 'required|exists:list_beritas,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tipe_konten' => 'required|string|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Menangani upload gambar jika ada
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('uploads/detail_berita', 'public');
            $validated['konten_gambar'] = $imagePath; // Assign the image path to the validated data
        }

        // Update data di database
        $detailBerita->update($validated);

        return redirect()->route('detail-beritas.index')->with('success', 'Detail Berita berhasil diperbarui.');
    }

    /**
     * Menghapus data detail berita dari database.
     */
    public function destroy(DetailBerita $detailBerita)
    {
        

        // Hapus data
        $detailBerita->delete();

        return redirect()->route('detail-beritas.index')->with('success', 'Detail Berita berhasil dihapus.');
    }
}
