<?php

namespace App\Http\Controllers;

use App\Models\MhtqKeunggulan;
use Illuminate\Http\Request;

class MhtqKeunggulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all records from the mhtq_keunggulans table
        $keunggulans = MhtqKeunggulan::paginate(10);

        // Pass the data to the view
        return view('mhtq_keunggulans.index', compact('keunggulans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mhtq_keunggulans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        // Create a new record
        MhtqKeunggulan::create($request->all());

        return redirect()->route('mhtq_keunggulans.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the record by ID
        $keunggulan = MhtqKeunggulan::findOrFail($id);

        // Pass the record to the edit view
        return view('mhtq_keunggulans.edit', compact('keunggulan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        // Find the record and update it
        $keunggulan = MhtqKeunggulan::findOrFail($id);
        $keunggulan->update($request->all());

        return redirect()->route('mhtq_keunggulans.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the record and delete it
        $keunggulan = MhtqKeunggulan::findOrFail($id);
        $keunggulan->delete();

        return redirect()->route('mhtq_keunggulans.index')->with('success', 'Data berhasil dihapus.');
    }
}
