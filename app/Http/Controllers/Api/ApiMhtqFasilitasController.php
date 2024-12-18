<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MhtqFasilitas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiMhtqFasilitasController extends Controller
{
    // Menampilkan semua data MhtqFasilitas
    public function index()
    {
        $data = MhtqFasilitas::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
