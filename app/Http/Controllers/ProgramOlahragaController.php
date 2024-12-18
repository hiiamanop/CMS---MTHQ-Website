<?php

namespace App\Http\Controllers;

use App\Models\ProgramOlahraga;
use Illuminate\Http\Request;

class ProgramOlahragaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programOlahragas = ProgramOlahraga::paginate(10);
        return view('program_olahraga.index', compact('programOlahragas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program_olahraga.create');
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

        ProgramOlahraga::create($request->all());

        return redirect()->route('program_olahraga.index')->with('success', 'Program Olahraga berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramOlahraga $program_olahraga)
    {
        return view('program_olahraga.edit', compact('program_olahraga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramOlahraga $program_olahraga)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $program_olahraga->update($request->all());

        return redirect()->route('program_olahraga.index')->with('success', 'Program Olahraga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramOlahraga $program_olahraga)
    {
        $program_olahraga->delete();
        return redirect()->route('program_olahraga.index')->with('success', 'Program Olahraga berhasil dihapus.');
    }
}
