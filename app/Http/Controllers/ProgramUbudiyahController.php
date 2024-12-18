<?php

namespace App\Http\Controllers;

use App\Models\ProgramUbudiyah;
use Illuminate\Http\Request;

class ProgramUbudiyahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programUbudiyahs = ProgramUbudiyah::paginate(10);
        return view('program_ubudiyah.index', compact('programUbudiyahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program_ubudiyah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        ProgramUbudiyah::create([
            'nama_attribute' => $request->nama_attribute,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('program_ubudiyah.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramUbudiyah $programUbudiyah)
    {
        return view('program_ubudiyah.edit', compact('programUbudiyah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramUbudiyah $programUbudiyah)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $programUbudiyah->update([
            'nama_attribute' => $request->nama_attribute,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('program_ubudiyah.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramUbudiyah $programUbudiyah)
    {
        $programUbudiyah->delete();
        return redirect()->route('program_ubudiyah.index')->with('success', 'Data berhasil dihapus');
    }
}
