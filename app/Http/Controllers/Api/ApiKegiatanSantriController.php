<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KegiatanSantri;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiKegiatanSantriController extends Controller
{
    //
    public function index()
    {
        $data = KegiatanSantri::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
