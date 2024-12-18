<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramPengasuhan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProgramPengasuhanController extends Controller
{
    // Menampilkan semua data ProgramPengasuhan
    public function index()
    {
        $data = ProgramPengasuhan::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
