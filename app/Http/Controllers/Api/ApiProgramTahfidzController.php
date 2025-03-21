<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramTahfidz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProgramTahfidzController extends Controller
{
    // Menampilkan semua data ProgramTahfidz
    public function index()
    {
        $data = ProgramTahfidz::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
