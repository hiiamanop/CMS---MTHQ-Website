<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramOlahraga;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProgramOlahragaController extends Controller
{
    // Menampilkan semua data ProgramOlahraga
    public function index()
    {
        $data = ProgramOlahraga::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
