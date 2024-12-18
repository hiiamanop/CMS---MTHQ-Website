<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     */
    public function index()
    {
        // Menghitung jumlah warga berdasarkan jenis_warga
        $jumlahSiswa = Warga::where('jenis_warga', 'siswa')->sum('jumlah');
        $jumlahPengajar = Warga::where('jenis_warga', 'pengajar')->sum('jumlah');
        $jumlahStaff = Warga::where('jenis_warga', 'staff')->sum('jumlah');

        // Kirim data ke view
        return view('dashboard.index', compact('jumlahSiswa', 'jumlahPengajar', 'jumlahStaff'));
    }
}
