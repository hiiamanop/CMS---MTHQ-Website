<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    // Menampilkan semua data kontak
    public function index()
    {
        $kontaks = Kontak::paginate(10);
        return view('kontaks.index', compact('kontaks'));
    }

    // Menampilkan form untuk membuat kontak baru
    public function create()
    {
        return view('kontaks.create');
    }

    // Menyimpan data kontak baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:500',
        ]);

        Kontak::create($validated);

        return redirect()->route('kontaks.index')->with('success', 'Kontak berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit kontak
    public function edit($id)
    {
        $kontak = Kontak::findOrFail($id);
        return view('kontaks.edit', compact('kontak'));
    }

    // Memperbarui data kontak
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:500',
        ]);

        $kontak = Kontak::findOrFail($id);
        $kontak->update($validated);

        return redirect()->route('kontaks.index')->with('success', 'Kontak berhasil diperbarui');
    }

    // Menghapus kontak
    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('kontaks.index')->with('success', 'Kontak berhasil dihapus');
    }
}
