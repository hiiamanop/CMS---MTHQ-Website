<?php

namespace App\Http\Controllers;

use App\Models\TentangMhtqPendiri;
use Illuminate\Http\Request;

class TentangMhtqPendiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tentangMhtqPendiris = TentangMhtqPendiri::paginate(10);
        return view('tentang_mhtq_pendiri.index', compact('tentangMhtqPendiris'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tentang_mhtq_pendiri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $item = TentangMhtqPendiri::create($validated);

        return redirect()->route('tentang_mhtq_pendiri.index')->with('success', 'attribute created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = TentangMhtqPendiri::find($id);

        if (!$item) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pendiri = TentangMhtqPendiri::findOrFail($id);
        return view('tentang_mhtq_pendiri.edit', compact('pendiri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $item = TentangMhtqPendiri::find($id);

        if (!$item) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $item->update($validated);

        return redirect()->route('tentang_mhtq_pendiri.index')->with('success', 'attribute edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = TentangMhtqPendiri::find($id);

        if (!$item) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $item->delete();

        return redirect()->route('tentang_mhtq_pendiri.index')->with('success', 'attribute deleted successfully');
    }
}
