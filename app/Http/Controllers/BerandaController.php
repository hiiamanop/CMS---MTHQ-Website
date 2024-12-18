<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    // Menampilkan halaman index
    public function index()
    {

        // Gunakan paginate() dengan jumlah item per halaman
        $berandas = Beranda::paginate(10);
        return view('berandas.index', compact('berandas'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('berandas.create');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        Beranda::create([
            'nama_attribute' => $request->input('nama_attribute'),
            'keterangan' => $request->input('keterangan'),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('berandas.index')->with('success', 'Data berhasil ditambahkan.');
    }


    // Menampilkan data tertentu (optional)
    public function show(Beranda $beranda)
    {
        return view('beranda.show', compact('beranda'));
    }

    // Menampilkan form edit
    public function edit(Beranda $beranda)
    {
        return view('berandas.edit', compact('beranda'));
    }

    // Update data di database
    public function update(Request $request, Beranda $beranda)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        // Update data
        $beranda->update([
            'nama_attribute' => $request->nama_attribute,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('berandas.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy(Beranda $beranda)
    {
        $beranda->delete();
        return redirect()->route('berandas.index')->with('success', 'Data berhasil dihapus!');
    }
}
