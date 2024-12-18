<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class KalenderAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kalenders = KalenderAkademik::paginate(10); // Paginate 10 items per page
        return view('kalender_akademiks.index', compact('kalenders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kalender_akademiks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'gambar'         => 'required|file|mimes:jpeg,png,jpg|max:2048', // Validasi file
        ]);

        // Proses file gambar
        if ($request->hasFile('gambar')) {
            // Simpan file gambar ke dalam storage/public/kalender_akademik
            $gambarPath = $request->file('gambar')->store('kalender_akademik', 'public');
        }

        // Simpan data ke database
        KalenderAkademik::create([
            'nama_attribute' => $request->nama_attribute,
            'gambar' => $gambarPath, // Simpan path gambar
        ]);

        return redirect()->route('kalender_akademiks.index')
            ->with('success', 'Kalender Akademik berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kalender = KalenderAkademik::findOrFail($id);
        return view('kalender_akademiks.edit', compact('kalender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'gambar'         => 'required|file|mimes:jpeg,png,jpg|max:2048', // Validasi file

        ]);

        $kalender = KalenderAkademik::findOrFail($id);
        $kalender->update($request->all());

        return redirect()->route('kalender_akademiks.index')
            ->with('success', 'Kalender Akademik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kalender = KalenderAkademik::findOrFail($id);
        $kalender->delete();

        return redirect()->route('kalender_akademiks.index')
            ->with('success', 'Kalender Akademik berhasil dihapus.');
    }
}
