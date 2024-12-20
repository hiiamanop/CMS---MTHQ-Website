<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use App\Models\Section;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Menampilkan daftar data Beranda.
     */
    public function index()
    {
        $berandas = Beranda::with('section')->paginate(10); // Eager loading untuk relasi section
        return view('beranda.index', compact('berandas'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        $sections = Section::all(); // Mengambil semua data section untuk dropdown
        return view('beranda.create', compact('sections'));
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'required|string|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menangani upload gambar jika ada
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('uploads/beranda', 'public');
            $validated['konten_gambar'] = $imagePath;
        }

        // Simpan data ke database
        Beranda::create($validated);

        return redirect()->route('berandas.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk edit data.
     */
    public function edit(Beranda $beranda)
    {
        $sections = Section::all();
        return view('beranda.edit', compact('beranda', 'sections'));
    }

    /**
     * Memperbarui data di database.
     */
    public function update(Request $request, Beranda $beranda)
    {
        $validated = $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'tipe_konten' => 'required|string|in:teks,gambar',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menangani upload gambar jika ada
        if ($request->hasFile('konten_gambar')) {
            $imagePath = $request->file('konten_gambar')->store('uploads/beranda', 'public');
            $validated['konten_gambar'] = $imagePath;
        }

        $beranda->update($validated);

        return redirect()->route('berandas.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(Beranda $beranda)
    {
        $beranda->delete();
        return redirect()->route('berandas.index')->with('success', 'Data berhasil dihapus.');
    }
}
