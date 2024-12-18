<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramKesehatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProgramKesehatanController extends Controller
{
    // Menampilkan semua data ProgramKesehatan
    public function index()
    {
        $data = ProgramKesehatan::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
