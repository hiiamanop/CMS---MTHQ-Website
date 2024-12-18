<?php

namespace App\Http\Controllers;

use App\Models\ProgramKesehatan;
use Illuminate\Http\Request;

class ProgramKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programKesehatans = ProgramKesehatan::paginate(10);
        return view('program_kesehatan.index', compact('programKesehatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program_kesehatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        ProgramKesehatan::create($request->all());

        return redirect()->route('program_kesehatan.index')
                         ->with('success', 'Data Program Kesehatan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programKesehatan = ProgramKesehatan::findOrFail($id);
        return view('program_kesehatan.edit', compact('programKesehatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $programKesehatan = ProgramKesehatan::findOrFail($id);
        $programKesehatan->update($request->all());

        return redirect()->route('program_kesehatan.index')
                         ->with('success', 'Data Program Kesehatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $programKesehatan = ProgramKesehatan::findOrFail($id);
        $programKesehatan->delete();

        return redirect()->route('program_kesehatan.index')
                         ->with('success', 'Data Program Kesehatan berhasil dihapus.');
    }
}
