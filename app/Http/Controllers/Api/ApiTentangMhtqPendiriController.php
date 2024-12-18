<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TentangMhtqPendiri;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTentangMhtqPendiriController extends Controller
{
    // Menampilkan semua data TentangMhtqPendiri
    public function index()
    {
        $data = TentangMhtqPendiri::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
