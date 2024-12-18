<?php

namespace App\Http\Controllers;

use App\Models\KegiatanSantri;
use Illuminate\Http\Request;

class KegiatanSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data kegiatan santri
        $kegiatanSantris = KegiatanSantri::paginate(10);

        // Tampilkan halaman index
        return view('kegiatan_santris.index', compact('kegiatanSantris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form create
        return view('kegiatan_santris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        KegiatanSantri::create([
            'nama_attribute' => $request->input('nama_attribute'),
            'keterangan' => $request->input('keterangan'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kegiatan_santris.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kegiatanSantri = KegiatanSantri::find($id);
        return view('kegiatan_santris.edit', compact('kegiatanSantri'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:500',
        ]);

        $kegiatanSantri = KegiatanSantri::find($id);
        $kegiatanSantri->update($request->all());

        return redirect()->route('kegiatan_santris.index')->with('success', 'Data berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KegiatanSantri $kegiatanSantri)
    {
        // Hapus data
        $kegiatanSantri->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('kegiatan_santris.index')->with('success', 'Data berhasil dihapus.');
    }
}
