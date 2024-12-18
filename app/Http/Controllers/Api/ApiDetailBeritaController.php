<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailBerita;
use Illuminate\Http\Response;


class ApiDetailBeritaController extends Controller
{
    // Menampilkan semua data DetailBerita
    public function index()
    {
        $data = DetailBerita::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
