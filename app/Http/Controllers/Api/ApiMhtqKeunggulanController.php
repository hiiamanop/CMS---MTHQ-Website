<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MhtqKeunggulan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiMhtqKeunggulanController extends Controller
{
    // Menampilkan semua data MhtqKeunggulan
    public function index()
    {
        $data = MhtqKeunggulan::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
