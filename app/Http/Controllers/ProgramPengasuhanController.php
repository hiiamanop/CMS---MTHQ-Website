<?php

namespace App\Http\Controllers;

use App\Models\ProgramPengasuhan;
use Illuminate\Http\Request;

class ProgramPengasuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programPengasuhans = ProgramPengasuhan::paginate(10);
        return view('program_pengasuhan.index', compact('programPengasuhans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program_pengasuhan.create');
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

        // Simpan data
        ProgramPengasuhan::create($request->all());

        return redirect()->route('program_pengasuhan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramPengasuhan $programPengasuhan)
    {
        return view('program_pengasuhan.show', compact('programPengasuhan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramPengasuhan $programPengasuhan)
    {
        return view('program_pengasuhan.edit', compact('programPengasuhan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramPengasuhan $programPengasuhan)
    {
        // Validasi input
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        // Update data
        $programPengasuhan->update($request->all());

        return redirect()->route('program_pengasuhan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramPengasuhan $programPengasuhan)
    {
        $programPengasuhan->delete();
        return redirect()->route('program_pengasuhan.index')->with('success', 'Data berhasil dihapus.');
    }
}
