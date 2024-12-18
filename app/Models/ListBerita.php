<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBerita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_berita',
        'kategori_berita',
        'tanggal_upload',
        'highlight_berita',
    ];
}
