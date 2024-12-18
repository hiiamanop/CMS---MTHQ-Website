<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramBahasa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProgramBahasaController extends Controller
{
    // Menampilkan semua data ProgramBahasa
    public function index()
    {
        $data = ProgramBahasa::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
