<?php

namespace App\Http\Controllers;

use App\Models\ProgramBahasa;
use Illuminate\Http\Request;

class ProgramBahasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programBahasas = ProgramBahasa::paginate(10);
        return view('program_bahasas.index', compact('programBahasas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program_bahasas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        // Simpan ke database
        ProgramBahasa::create($request->all());

        return redirect()->route('program_bahasas.index')
                         ->with('success', 'Program Bahasa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramBahasa $programBahasa)
    {
        return view('program_bahasas.show', compact('programBahasa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramBahasa $programBahasa)
    {
        return view('program_bahasas.edit', compact('programBahasa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramBahasa $programBahasa)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        // Update data
        $programBahasa->update($request->all());

        return redirect()->route('program_bahasas.index')
                         ->with('success', 'Program Bahasa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramBahasa $programBahasa)
    {
        $programBahasa->delete();

        return redirect()->route('program_bahasas.index')
                         ->with('success', 'Program Bahasa berhasil dihapus.');
    }
}
