<?php

namespace App\Http\Controllers;

use App\Models\ProgramTalim;
use Illuminate\Http\Request;

class ProgramTalimController extends Controller
{
    public function index()
    {
        $programTalims = ProgramTalim::paginate(10);
        return view('program_talim.index', compact('programTalims'));
    }

    public function create()
    {
        return view('program_talim.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        ProgramTalim::create($request->all());
        return redirect()->route('program_talim.index')->with('success', 'Program Talim created successfully');
    }

    public function edit($id)
    {
        $programTalim = ProgramTalim::findOrFail($id);
        return view('program_talim.edit', compact('programTalim'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $programTalim = ProgramTalim::findOrFail($id);
        $programTalim->update($request->all());
        return redirect()->route('program_talim.index')->with('success', 'Program Talim updated successfully');
    }

    public function destroy($id)
    {
        ProgramTalim::destroy($id);
        return redirect()->route('program_talim.index')->with('success', 'Program Talim deleted successfully');
    }
}
