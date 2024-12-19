<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use App\Models\Section;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    // Menampilkan halaman index
    public function index()
    {

        // Ambil semua data Beranda dengan pagination
        $berandas = Beranda::with('section')->paginate(10);

        return view('berandas.index', compact('berandas'));
    }

    // Menampilkan form create
    public function create()
    {
        $sections = Section::all(); // Mengambil semua data sections
        return view('berandas.create', compact('sections'));
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        try {
            Beranda::create($request->all());
            // Gunakan session()->flash() untuk memastikan
            session()->flash('success', 'Data berhasil ditambahkan.');
            return redirect()->route('berandas.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menambahkan data.');
            return redirect()->route('berandas.index');
        }
    }



    // Menampilkan data tertentu (optional)
    public function show(Beranda $beranda)
    {
        return view('beranda.show', compact('beranda'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $beranda = Beranda::findOrFail($id);
        $sections = Section::all();

        return view('berandas.edit', compact('beranda', 'sections'));
    }
    // Update data di database
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'section_id' => 'nullable|exists:sections,id',
            'nama_attribute' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $beranda = Beranda::findOrFail($id);
        $beranda->update($request->all());

        return redirect()->route('berandas.index')->with('success', 'Beranda berhasil diperbarui.');
    }

    // Menghapus data
    public function destroy($id)
    {
        $beranda = Beranda::findOrFail($id);
        $beranda->delete();

        return redirect()->route('berandas.index')->with('success', 'Beranda berhasil dihapus.');
    }
}
