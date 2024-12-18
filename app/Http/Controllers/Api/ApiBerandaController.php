<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Beranda;
use Illuminate\Http\Response;

class ApiBerandaController extends Controller
{
    //
    public function index()
    {
        $data = Beranda::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
