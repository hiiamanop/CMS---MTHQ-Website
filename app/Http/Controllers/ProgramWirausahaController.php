<?php

namespace App\Http\Controllers;

use App\Models\ProgramWirausaha;
use Illuminate\Http\Request;

class ProgramWirausahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programWirausahas = ProgramWirausaha::paginate(10);
        return view('program_wirausaha.index', compact('programWirausahas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program_wirausaha.create');
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

        // Simpan ke database
        ProgramWirausaha::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('program_wirausaha.index')->with('success', 'Program Wirausaha berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programWirausaha = ProgramWirausaha::findOrFail($id);
        return view('program_wirausaha.edit', compact('programWirausaha'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        // Update data
        $programWirausaha = ProgramWirausaha::findOrFail($id);
        $programWirausaha->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('program_wirausaha.index')->with('success', 'Program Wirausaha berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Hapus data
        $programWirausaha = ProgramWirausaha::findOrFail($id);
        $programWirausaha->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('program_wirausaha.index')->with('success', 'Program Wirausaha berhasil dihapus.');
    }
}
