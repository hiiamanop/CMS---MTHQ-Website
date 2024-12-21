<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator; // Fixed import for Validator
use Illuminate\Support\Facades\Storage;

class ApiKalenderAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kalenderAkademik = KalenderAkademik::with('section')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $kalenderAkademik
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_id' => 'required|exists:sections,id',
            'nama_attribute' => 'required|string',
            'tipe_konten' => 'required|string',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        // Handle file upload if there is a file
        if ($request->hasFile('konten_gambar')) {
            $path = $request->file('konten_gambar')->store('konten_gambar', 'public');
            $data['konten_gambar'] = $path;
        }

        $kalenderAkademik = KalenderAkademik::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Kalender Akademik created successfully',
            'data' => $kalenderAkademik
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kalenderAkademik = KalenderAkademik::with('section')->find($id);
        
        if (!$kalenderAkademik) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kalender Akademik not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $kalenderAkademik
        ], 200);
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, $id)
    {
        $kalenderAkademik = KalenderAkademik::find($id);

        if (!$kalenderAkademik) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kalender Akademik not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'section_id' => 'sometimes|required|exists:sections,id',
            'nama_attribute' => 'sometimes|required|string',
            'tipe_konten' => 'sometimes|required|string',
            'konten_teks' => 'nullable|string',
            'konten_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle file upload if there is a new file
        if ($request->hasFile('konten_gambar')) {
            // Delete old image if exists
            if ($kalenderAkademik->konten_gambar) {
                Storage::disk('public')->delete($kalenderAkademik->konten_gambar);
            }
            
            $path = $request->file('konten_gambar')->store('konten_gambar', 'public');
            $request->merge(['konten_gambar' => $path]);
        }

        $kalenderAkademik->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Kalender Akademik updated successfully',
            'data' => $kalenderAkademik
        ], 200);
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        $kalenderAkademik = KalenderAkademik::find($id);

        if (!$kalenderAkademik) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kalender Akademik not found'
            ], 404);
        }

        // Delete associated image if exists
        if ($kalenderAkademik->konten_gambar) {
            Storage::disk('public')->delete($kalenderAkademik->konten_gambar);
        }

        $kalenderAkademik->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Kalender Akademik deleted successfully'
        ], 200);
    }

    /**
     * Download the konten_gambar file.
     */
    public function downloadGambar($id)
    {
        $kalenderAkademik = KalenderAkademik::find($id);

        if (!$kalenderAkademik) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kalender Akademik not found'
            ], 404);
        }

        if (!$kalenderAkademik->konten_gambar) {
            return response()->json([
                'status' => 'error',
                'message' => 'No image file found for this record'
            ], 404);
        }

        $filePath = storage_path('app/public/' . $kalenderAkademik->konten_gambar);

        if (!file_exists($filePath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image file not found in storage'
            ], 404);
        }

        // Get the file mime type using PHP's built-in function
        $mimeType = mime_content_type($filePath);
        
        // Get original filename from path
        $filename = basename($kalenderAkademik->konten_gambar);

        // Return the file download response
        return response()->download($filePath, $filename, [
            'Content-Type' => $mimeType
        ]);
    }
}
