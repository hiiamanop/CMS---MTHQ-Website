<?php

namespace App\Http\Controllers;

use App\Models\TentangMhtqPimpinan;
use Illuminate\Http\Request;

class TentangMhtqPimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tentangMhtqPimpinans = TentangMhtqPimpinan::paginate(10);
        return view('tentang_mhtq_pimpinan.index', compact('tentangMhtqPimpinans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tentang_mhtq_pimpinan.create');
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

        TentangMhtqPimpinan::create($request->all());

        return redirect()->route('tentang_mhtq_pimpinan.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pimpinan = TentangMhtqPimpinan::findOrFail($id);
        return view('tentang_mhtq_pimpinan.edit', compact('pimpinan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TentangMhtqPimpinan $tentangMhtqPimpinan)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $tentangMhtqPimpinan->update($request->all());

        return redirect()->route('tentang_mhtq_pimpinan.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TentangMhtqPimpinan $tentangMhtqPimpinan)
    {
        $tentangMhtqPimpinan->delete();

        return redirect()->route('tentang_mhtq_pimpinan.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
