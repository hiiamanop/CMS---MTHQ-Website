<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramUbudiyah;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProgramUbudiyahController extends Controller
{
    // Menampilkan semua data ProgramUbudiyah
    public function index()
    {
        $data = ProgramUbudiyah::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
