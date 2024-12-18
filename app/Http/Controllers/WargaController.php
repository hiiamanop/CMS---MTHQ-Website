<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wargas = Warga::paginate(10);  // Paginate results, adjust 10 to the number of records per page
        return view('warga.index', compact('wargas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'jenis_warga' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
        ]);

        // Simpan data ke database
        Warga::create([
            'jenis_warga' => $request->jenis_warga,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warga $warga)
    {
        // Validasi data input
        $request->validate([
            'jenis_warga' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
        ]);

        // Update data di database
        $warga->update([
            'jenis_warga' => $request->jenis_warga,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
