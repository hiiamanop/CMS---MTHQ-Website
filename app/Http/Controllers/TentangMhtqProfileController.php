<?php

namespace App\Http\Controllers;

use App\Models\TentangMhtqProfile;
use Illuminate\Http\Request;

class TentangMhtqProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tentangMhtqProfiles = TentangMhtqProfile::paginate(10);
        return view('tentang_mhtq_profiles.index', compact('tentangMhtqProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tentang_mhtq_profiles.create');
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

        TentangMhtqProfile::create($request->all());

        return redirect()->route('tentang_mhtq_profiles.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TentangMhtqProfile $tentang_mhtq_profile)
    {
        return view('tentang_mhtq_profiles.show', compact('tentang_mhtq_profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TentangMhtqProfile $tentang_mhtq_profile)
    {
        return view('tentang_mhtq_profiles.edit', compact('tentang_mhtq_profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TentangMhtqProfile $tentang_mhtq_profile)
    {
        $request->validate([
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $tentang_mhtq_profile->update($request->all());

        return redirect()->route('tentang_mhtq_profiles.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TentangMhtqProfile $tentang_mhtq_profile)
    {
        $tentang_mhtq_profile->delete();

        return redirect()->route('tentang_mhtq_profiles.index')->with('success', 'Data berhasil dihapus.');
    }
}
