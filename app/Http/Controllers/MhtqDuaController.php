<?php

namespace App\Http\Controllers;

use App\Models\MhtqDua;
use Illuminate\Http\Request;

class MhtqDuaController extends Controller
{
    // Show all MhtqDua records
    public function index()
    {
        // Ambil semua data kegiatan santri
        $mhtqDuas = MhtqDua::paginate(10);
        return view('mhtq_duas.index', compact('mhtqDuas'));
    }

    // Show the form to create a new MhtqDua record
    public function create()
    {
        return view('mhtq_duas.create');
    }

    // Store a new MhtqDua record
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        MhtqDua::create($request->all());

        return redirect()->route('mhtq_duas.index')->with('success', 'Data successfully created.');
    }

    // Show the form to edit an existing MhtqDua record
    public function edit($id)
    {
        $mhtqDua = MhtqDua::findOrFail($id);
        return view('mhtq_duas.edit', compact('mhtqDua'));
    }

    // Update an existing MhtqDua record
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $mhtqDua = MhtqDua::findOrFail($id);
        $mhtqDua->update($request->all());

        return redirect()->route('mhtq_duas.index')->with('success', 'Data successfully updated.');
    }

    // Delete an existing MhtqDua record
    public function destroy($id)
    {
        $mhtqDua = MhtqDua::findOrFail($id);
        $mhtqDua->delete();

        return redirect()->route('mhtq_duas.index')->with('success', 'Data successfully deleted.');
    }
}
