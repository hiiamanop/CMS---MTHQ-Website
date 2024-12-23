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
        // Data pengguna yang sedang login
        $currentUser = auth()->user();

        // Kirim data ke view
        return view('dashboard.index', compact('currentUser'));
    }
}
