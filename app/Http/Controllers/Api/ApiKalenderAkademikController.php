<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiKalenderAkademikController extends Controller
{
    // Menampilkan semua data KalenderAkademik
    public function index()
    {
        $data = KalenderAkademik::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
