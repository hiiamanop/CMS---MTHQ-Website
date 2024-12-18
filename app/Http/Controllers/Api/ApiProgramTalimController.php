<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramTalim;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProgramTalimController extends Controller
{
    // Menampilkan semua data ProgramTalim
    public function index()
    {
        $data = ProgramTalim::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
