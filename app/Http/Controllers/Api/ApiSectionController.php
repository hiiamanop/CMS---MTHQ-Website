<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class ApiSectionController extends Controller
{
    // Fetch all sections with their relationships
    public function index()
    {
        $sections = Section::with([
            'berandas', 
            'kegiatan_santris', 
            'mhtq_duas', 
            'detail_beritas', 
            'galeris', 
            'kalender_akademiks',
            'kontaks', 
            'list_beritas', 
            'mhtq_fasilitass', 
            'mhtq_keunggulans', 
            'program_bahasas', 
            'program_keamanans', 
            'program_kesehatans', 
            'program_olahragas',
            'program_Pengasuhans', 
            'program_Tahfidzs', 
            'program_Talims', 
            'program_Ubudiyahs', 
            'program_Wirausahas', 
            'TentangMhtqPendiris',
            'TentangMhtqPimpinans', 
            'TentangMhtqProfiles'
        ])->get();

        return response()->json($sections);
    }

    // Show a specific section by id
    public function show($id)
    {
        $section = Section::with([
            'berandas', 
            'kegiatan_santris', 
            'mhtq_duas', 
            'detail_beritas', 
            'galeris', 
            'kalender_akademiks',
            'kontaks', 
            'list_beritas', 
            'mhtq_fasilitass', 
            'mhtq_keunggulans', 
            'program_bahasas', 
            'program_keamanans', 
            'program_kesehatans', 
            'program_olahragas',
            'program_Pengasuhans', 
            'program_Tahfidzs', 
            'program_Talims', 
            'program_Ubudiyahs', 
            'program_Wirausahas', 
            'TentangMhtqPendiris',
            'TentangMhtqPimpinans', 
            'TentangMhtqProfiles'
        ])->find($id);

        if (!$section) {
            return response()->json(['message' => 'Section not found'], 404);
        }

        return response()->json($section);
    }

    // Create a new section
    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        $section = Section::create([
            'item' => $request->item,
            'section' => $request->section,
        ]);

        return response()->json($section, 201);
    }

    // Update a specific section
    public function update(Request $request, $id)
    {
        $section = Section::find($id);

        if (!$section) {
            return response()->json(['message' => 'Section not found'], 404);
        }

        $request->validate([
            'item' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        $section->update([
            'item' => $request->item,
            'section' => $request->section,
        ]);

        return response()->json($section);
    }

    // Delete a specific section
    public function destroy($id)
    {
        $section = Section::find($id);

        if (!$section) {
            return response()->json(['message' => 'Section not found'], 404);
        }

        $section->delete();

        return response()->json(['message' => 'Section deleted successfully']);
    }
}
