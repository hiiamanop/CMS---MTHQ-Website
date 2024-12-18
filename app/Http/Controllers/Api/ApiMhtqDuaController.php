<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MhtqDua;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiMhtqDuaController extends Controller
{
    // Menampilkan semua data MhtqDua
    public function index()
    {
        $data = MhtqDua::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
