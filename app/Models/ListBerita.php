<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBerita extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id', // Relasi dengan tabel sections
        'judul_berita',
        'kategori_berita',
        'tanggal_upload',
        'highlight_berita',
        'tipe_konten',
        'konten_teks',
        'konten_gambar'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
