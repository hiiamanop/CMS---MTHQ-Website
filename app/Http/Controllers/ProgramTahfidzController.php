<?php

namespace App\Http\Controllers;

use App\Models\ProgramTahfidz;
use Illuminate\Http\Request;

class ProgramTahfidzController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $programTahfidzs = ProgramTahfidz::paginate(10);
        return view('program_tahfidz.index', compact('programTahfidzs'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('program_tahfidz.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        ProgramTahfidz::create($request->all());

        return redirect()->route('program_tahfidz.index')->with('success', 'Program Tahfidz created successfully.');
    }

    // Display the specified resource.
    public function show(ProgramTahfidz $programTahfidz)
    {
        return view('program_tahfidz.show', compact('programTahfidz'));
    }

    // Show the form for editing the specified resource.
    public function edit(ProgramTahfidz $programTahfidz)
    {
        return view('program_tahfidz.edit', compact('programTahfidz'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, ProgramTahfidz $programTahfidz)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $programTahfidz->update($request->all());

        return redirect()->route('program_tahfidz.index')->with('success', 'Program Tahfidz updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(ProgramTahfidz $programTahfidz)
    {
        $programTahfidz->delete();

        return redirect()->route('program_tahfidz.index')->with('success', 'Program Tahfidz deleted successfully.');
    }
}
