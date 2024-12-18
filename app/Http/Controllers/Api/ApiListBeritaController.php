<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ListBerita;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiListBeritaController extends Controller
{
    // Menampilkan semua data ListBerita
    public function index()
    {
        $data = ListBerita::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
