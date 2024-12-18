<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeamanan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProgramKeamananController extends Controller
{
    // Menampilkan semua data ProgramKeamanan
    public function index()
    {
        $data = ProgramKeamanan::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
