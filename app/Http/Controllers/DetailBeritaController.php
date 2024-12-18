<?php

namespace App\Http\Controllers;

use App\Models\DetailBerita;
use App\Models\ListBerita;
use Illuminate\Http\Request;

class DetailBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailBeritas = DetailBerita::with('listBerita')->paginate(10);
        return view('detail_beritas.index', compact('detailBeritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listBeritas = ListBerita::all();
        return view('detail_beritas.create', compact('listBeritas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'list_berita_id' => 'nullable|exists:list_beritas,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        DetailBerita::create($request->all());

        return redirect()->route('detail_beritas.index')->with('success', 'Detail Berita berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detailBerita = DetailBerita::findOrFail($id);
        $listBeritas = ListBerita::all();
        return view('detail_beritas.edit', compact('detailBerita', 'listBeritas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'list_berita_id' => 'nullable|exists:list_beritas,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $detailBerita = DetailBerita::findOrFail($id);
        $detailBerita->update($request->all());

        return redirect()->route('detail_beritas.index')->with('success', 'Detail Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detailBerita = DetailBerita::findOrFail($id);
        $detailBerita->delete();

        return redirect()->route('detail_beritas.index')->with('success', 'Detail Berita berhasil dihapus.');
    }
}
