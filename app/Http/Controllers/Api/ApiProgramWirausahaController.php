<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramWirausaha;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProgramWirausahaController extends Controller
{
    // Menampilkan semua data ProgramWirausaha
    public function index()
    {
        $data = ProgramWirausaha::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
