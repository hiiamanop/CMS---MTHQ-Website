<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TentangMhtqProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTentangMhtqProfileController extends Controller
{
    // Menampilkan semua data TentangMhtqProfile
    public function index()
    {
        $data = TentangMhtqProfile::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
