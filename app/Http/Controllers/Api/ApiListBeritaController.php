<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ListBerita;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class ApiListBeritaController extends Controller
{
    // Menampilkan semua data ListBerita
    public function index(Request $request)
    {
        $query = ListBerita::query();
        
        // Filter by date
        if ($request->has('date_filter')) {
            $dateFilter = $request->date_filter;
            $now = Carbon::now();
            
            switch ($dateFilter) {
                case 'today':
                    $query->whereDate('tanggal_upload', $now->toDateString());
                    break;
                case 'this_week':
                    $query->whereBetween('tanggal_upload', [
                        $now->startOfWeek()->toDateString(),
                        $now->endOfWeek()->toDateString()
                    ]);
                    break;
                case 'this_month':
                    $query->whereMonth('tanggal_upload', $now->month)
                          ->whereYear('tanggal_upload', $now->year);
                    break;
            }
        }
        
        // Filter by kategori
        if ($request->has('kategori')) {
            $kategori = $request->kategori;
            $query->where('kategori_berita', $kategori);
        }
        
        // Search
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul_berita', 'like', "%{$searchTerm}%")
                  ->orWhere('highlight_berita', 'like', "%{$searchTerm}%")
                  ->orWhere('konten_teks', 'like', "%{$searchTerm}%");
            });
        }
        
        $data = $query->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Beranda',
            'data' => $data
        ], Response::HTTP_OK);
    }
}