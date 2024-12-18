<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TentangMhtqPimpinan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTentangMhtqPimpinanController extends Controller
{
    // Menampilkan semua data TentangMhtqPimpinan
    public function index()
    {
        $data = TentangMhtqPimpinan::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
