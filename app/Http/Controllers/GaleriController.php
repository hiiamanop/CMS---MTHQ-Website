<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data galeri
        $galeris = Galeri::paginate(10);
        return view('galeri.index', compact('galeris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'jenis_galeri'   => 'required|in:kegiatan_santri,program_pendidikan,wisuda_akbar',
            'keterangan'     => 'required|string',
            'gambar'         => 'required|file|mimes:jpeg,png,jpg|max:2048', // Validasi file
        ]);

        // Proses upload file
        $gambarPath = $request->file('gambar')->store('galeri_images', 'public');

        // Simpan data galeri
        $galeri = Galeri::create([
            'nama_attribute' => $request->input('nama_attribute'),
            'jenis_galeri'   => $request->input('jenis_galeri'),
            'keterangan'     => $request->input('keterangan'),
            'gambar'         => $gambarPath,
        ]);

        return redirect()->route('galeris.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        // Ambil data galeri berdasarkan id
        $galeri = Galeri::findOrFail($id);

        // Tampilkan view edit dan kirim data galeri ke view
        return view('galeri.edit', compact('galeri'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil satu data galeri
        $galeri = Galeri::findOrFail($id);
        return response()->json($galeri);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'jenis_galeri'   => 'required|in:kegiatan_santri,program_pendidikan,wisuda_akbar',
            'keterangan'     => 'required|string',
            'gambar'         => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil data galeri berdasarkan id
        $galeri = Galeri::findOrFail($id);

        // Update data galeri
        $dataUpdate = [
            'nama_attribute' => $request->input('nama_attribute'),
            'jenis_galeri'   => $request->input('jenis_galeri'),
            'keterangan'     => $request->input('keterangan'),
            'galeri'         => $request->input('galeri'),
        ];

        // Jika ada gambar baru, upload dan update path gambar
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('galeri_images', 'public');
            $dataUpdate['gambar'] = $gambarPath;
        }

        $galeri->update($dataUpdate);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('galeris.index')->with('success', 'Data galeri berhasil diperbarui!');
    }

    public function create()
    {
        return view('galeri.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data galeri
        $galeri = Galeri::findOrFail($id);
        $galeri->delete();

        return redirect()->route('galeris.index')->with('success', 'Data berhasil dihapus.');
    }
}
