<?php

namespace App\Http\Controllers;

use App\Models\MhtqDua;
use App\Models\Section;
use Illuminate\Http\Request;

class MhtqDuaController extends Controller
{
    // Show all MhtqDua records
    public function index()
    {
        // Ambil semua data kegiatan santri
        $mhtqDuas = MhtqDua::with('section')->paginate(10);
        return view('mhtq_duas.index', compact('mhtqDuas'));
    }

    // Show the form to create a new MhtqDua record
    public function create()
    {
        $sections = Section::all();
        return view('mhtq_duas.create', compact('sections'));
    }

    // Store a new MhtqDua record
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        MhtqDua::create($request->all());

        return redirect()->route('mhtq_duas.index')->with('success', 'Data berhasil disimpan!');
    }

    // Show the form to edit an existing MhtqDua record
    public function edit(MhtqDua $mhtqDua)
    {
        $sections = Section::all();
        return view('mhtq_duas.edit', compact('mhtqDua', 'sections'));
    }

    // Update an existing MhtqDua record
    public function update(Request $request, MhtqDua $mhtqDua)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $mhtqDua->update($request->all());

        return redirect()->route('mhtq_duas.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Delete an existing MhtqDua record
    public function destroy(MhtqDua $mhtqDua)
    {
        $mhtqDua->delete();
        return redirect()->route('mhtq_duas.index')->with('success', 'Data berhasil dihapus!');
    }
}
