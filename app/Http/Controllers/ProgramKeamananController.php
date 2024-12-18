<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeamanan;
use Illuminate\Http\Request;

class ProgramKeamananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data program keamanan
        $programKeamanans = ProgramKeamanan::paginate(10);
        return view('program_keamanan.index', compact('programKeamanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program_keamanan.create');
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
        ProgramKeamanan::create($request->all());

        return redirect()->route('program_keamanan.index')->with('success', 'Program Keamanan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramKeamanan $program_keamanan)
    {
        return view('program_keamanan.edit', compact('program_keamanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramKeamanan $program_keamanan)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        // Update data
        $program_keamanan->update($request->all());

        return redirect()->route('program_keamanan.index')->with('success', 'Program Keamanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramKeamanan $program_keamanan)
    {
        // Hapus data
        $program_keamanan->delete();

        return redirect()->route('program_keamanan.index')->with('success', 'Program Keamanan berhasil dihapus.');
    }
}
