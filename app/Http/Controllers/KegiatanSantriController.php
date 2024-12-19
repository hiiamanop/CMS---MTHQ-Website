<?php

namespace App\Http\Controllers;

use App\Models\KegiatanSantri;
use App\Models\Section;
use Illuminate\Http\Request;

class KegiatanSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatanSantris = KegiatanSantri::with('section')->paginate(10);
        return view('kegiatan_santris.index', compact('kegiatanSantris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all(); // Ambil semua data section
        return view('kegiatan_santris.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        KegiatanSantri::create($request->all());

        return redirect()->route('kegiatan_santris.index')->with('success', 'Kegiatan santri berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kegiatanSantri = KegiatanSantri::findOrFail($id);
        $sections = Section::all(); // Ambil semua data section
        return view('kegiatan_santris.edit', compact('kegiatanSantri', 'sections'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $kegiatanSantri = KegiatanSantri::findOrFail($id);
        $kegiatanSantri->update($request->all());

        return redirect()->route('kegiatan_santris.index')->with('success', 'Kegiatan santri berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatanSantri = KegiatanSantri::findOrFail($id);
        $kegiatanSantri->delete();

        return redirect()->route('kegiatan_santris.index')->with('success', 'Kegiatan santri berhasil dihapus.');
    }
}
