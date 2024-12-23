<?php

namespace App\Http\Controllers;

use App\Models\ListBerita;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = ListBerita::latest()->paginate(10);
        return view('list_beritas.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua data Section
        $sections = Section::all();

        // Opsional: kategori berita
        $kategoriOptions = ['berita', 'artikel'];

        return view('list_beritas.create', compact('sections', 'kategoriOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'kategori_berita' => 'required|in:berita,artikel',
            'judul_berita' => 'required|string|max:255',
            'tanggal_upload' => 'required|date',
            'highlight_berita' => 'required|string',
            'tipe_konten' => 'nullable|in:teks,gambar',
            'konten_teks' => 'nullable|required_if:tipe_konten,teks',
            'konten_gambar' => 'nullable|required_if:tipe_konten,gambar|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar jika tipe konten adalah gambar
        $kontenGambarPath = null;
        if ($request->hasFile('konten_gambar')) {
            $kontenGambarPath = $request->file('konten_gambar')->store('konten_gambar', 'public');
        }

        // Simpan data ke database
        ListBerita::create([
            'section_id' => $request->section_id,
            'kategori_berita' => $request->kategori_berita,
            'judul_berita' => $request->judul_berita,
            'tanggal_upload' => $request->tanggal_upload,
            'highlight_berita' => $request->highlight_berita,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $kontenGambarPath,
        ]);

        return redirect()->route('list_beritas.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ListBerita $listBerita)
    {
        return view('list_beritas.show', compact('listBerita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $listBerita = ListBerita::findOrFail($id);
        $sections = Section::all(); // Ambil semua section
        $kategoriOptions = ['berita', 'artikel']; // Kategori berita

        return view('list_beritas.edit', compact('listBerita', 'sections', 'kategoriOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ListBerita $listBerita)
    {
        // Validasi input
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'kategori_berita' => 'required|in:berita,artikel',
            'judul_berita' => 'required|string|max:255',
            'tanggal_upload' => 'required|date',
            'highlight_berita' => 'required|string',
            'tipe_konten' => 'nullable|in:teks,gambar',
            'konten_teks' => 'nullable|',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload gambar baru
        if ($request->hasFile('konten_gambar')) {
            // Hapus gambar lama jika ada
            if ($listBerita->konten_gambar) {
                Storage::disk('public')->delete($listBerita->konten_gambar);
            }

            // Simpan gambar baru
            $kontenGambarPath = $request->file('konten_gambar')->store('konten_gambar', 'public');
            $listBerita->konten_gambar = $kontenGambarPath;
        }

        // Update data
        $listBerita->update([
            'section_id' => $request->section_id,
            'kategori_berita' => $request->kategori_berita,
            'judul_berita' => $request->judul_berita,
            'tanggal_upload' => $request->tanggal_upload,
            'highlight_berita' => $request->highlight_berita,
            'tipe_konten' => $request->tipe_konten,
            'konten_teks' => $request->konten_teks,
            'konten_gambar' => $listBerita->konten_gambar,
        ]);

        return redirect()->route('list_beritas.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListBerita $listBerita)
    {
        // Hapus gambar jika ada
        if ($listBerita->konten_gambar) {
            Storage::disk('public')->delete($listBerita->konten_gambar);
        }

        // Hapus data
        $listBerita->delete();

        return redirect()->route('list_beritas.index')->with('success', 'Berita berhasil dihapus.');
    }
}
