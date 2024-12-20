<?php

namespace App\Http\Controllers;

use App\Models\DetailBerita;
use App\Models\ListBerita;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailBeritaController extends Controller
{
    // Menampilkan semua data Detail Berita
    public function index()
    {
        $detailBeritas = DetailBerita::with(['section', 'listBerita'])->paginate(10);
        return view('detail_beritas.index', compact('detailBeritas'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        $sections = Section::all();
        $listBeritas = ListBerita::all();
        return view('detail_beritas.create', compact('sections', 'listBeritas'));
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'list_berita_id' => 'nullable|exists:list_beritas,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Handle Upload Gambar
        if ($request->hasFile('konten_gambar')) {
            $data['konten_gambar'] = $request->file('konten_gambar')->store('konten_gambar', 'public');
        }

        DetailBerita::create($data);

        return redirect()->route('detail-beritas.index')->with('success', 'Detail berita berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit(DetailBerita $detailBerita)
    {
        $sections = Section::all();
        $listBeritas = ListBerita::all();
        return view('detail_beritas.edit', compact('detailBerita', 'sections', 'listBeritas'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, DetailBerita $detailBerita)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'list_berita_id' => 'nullable|exists:list_beritas,id',
            'nama_attribute' => 'required|string|max:255',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Handle Upload Gambar
        if ($request->hasFile('konten_gambar')) {
            // Hapus gambar lama jika ada
            if ($detailBerita->konten_gambar) {
                Storage::disk('public')->delete($detailBerita->konten_gambar);
            }

            $data['konten_gambar'] = $request->file('konten_gambar')->store('konten_gambar', 'public');
        }

        $detailBerita->update($data);

        return redirect()->route('detail-beritas.index')->with('success', 'Detail berita berhasil diperbarui.');
    }

    // Menghapus data
    public function destroy(DetailBerita $detailBerita)
    {
        if ($detailBerita->konten_gambar) {
            Storage::disk('public')->delete($detailBerita->konten_gambar);
        }

        $detailBerita->delete();

        return redirect()->route('detail-beritas.index')->with('success', 'Detail berita berhasil dihapus.');
    }
}
