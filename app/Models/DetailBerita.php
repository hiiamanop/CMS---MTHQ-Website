<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBerita extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan
    protected $table = 'detail_beritas';

    // Kolom yang dapat diisi
    protected $fillable = [
        'section_id',
        'list_berita_id',
        'nama_attribute',
        'konten_teks',
        'konten_gambar',
    ];

    // Relasi ke tabel Section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // Relasi ke tabel ListBerita
    public function listBerita()
    {
        return $this->belongsTo(ListBerita::class, 'list_berita_id');
    }
}
