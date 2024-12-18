<?php

namespace App\Http\Controllers;

use App\Models\MhtqFasilitas;
use Illuminate\Http\Request;

class MhtqFasilitasController extends Controller
{
    /**
     * Menampilkan daftar fasilitas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $fasilitass = MhtqFasilitas::paginate(10); // Mendapatkan semua data fasilitas
        return view('mhtq_fasilitass.index', compact('fasilitass')); // Menampilkan data ke view
    }

    /**
     * Menampilkan halaman form untuk menambah fasilitas baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('mhtq_fasilitass.create'); // Menampilkan halaman form create
    }

    /**
     * Menyimpan fasilitas baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        // Menyimpan data fasilitas
        MhtqFasilitas::create($request->all());

        return redirect()->route('mhtq_fasilitass.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    /**
     * Menampilkan halaman form untuk mengedit fasilitas yang ada.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Mengambil data fasilitas berdasarkan ID
        $fasilitas = MhtqFasilitas::findOrFail($id);

        // Menampilkan form edit dengan data fasilitas
        return view('mhtq_fasilitass.edit', compact('fasilitas'));
    }

    /**
     * Memperbarui data fasilitas yang ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        // Mencari data fasilitas berdasarkan ID dan memperbarui data
        $fasilitas = MhtqFasilitas::findOrFail($id);
        $fasilitas->update($request->all());

        // Redirect ke halaman daftar fasilitas dengan pesan sukses
        return redirect()->route('mhtq_fasilitass.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }
}
