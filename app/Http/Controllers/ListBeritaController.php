<?php

namespace App\Http\Controllers;

use App\Models\ListBerita;
use Illuminate\Http\Request;

class ListBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listBeritas = ListBerita::paginate(10);
        return view('list_beritas.index', compact('listBeritas'));
    }

    public function edit($id)
    {
        $listBerita = ListBerita::findOrFail($id);
        return view('list_beritas.edit', compact('listBerita'));
    }

    public function create()
    {
        return view('list_beritas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_berita' => 'required|string|max:255',
            'kategori_berita' => 'required|string',
            'tanggal_upload' => 'required|date',
            'highlight_berita' => 'required|string',
        ]);

        // Simpan data ke database
        ListBerita::create([
            'judul_berita' => $request->judul_berita,
            'kategori_berita' => $request->kategori_berita,
            'tanggal_upload' => $request->tanggal_upload,
            'highlight_berita' => $request->highlight_berita,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('list-beritas.index')->with('success', 'Berita berhasil ditambahkan!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_berita' => 'required|string|max:255',
            'kategori_berita' => 'required|string|max:255',
            'tanggal_upload' => 'required|date',
            'highlight_berita' => 'required|string',
        ]);

        $listBerita = ListBerita::findOrFail($id);
        $listBerita->update($request->all());
        // Redirect kembali dengan pesan sukses
        return redirect()->route('list-beritas.index')->with('success', 'Berita berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $listBerita = ListBerita::findOrFail($id);
        $listBerita->delete();
        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}
