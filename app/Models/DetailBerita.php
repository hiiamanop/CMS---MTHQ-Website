<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBerita extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'list_berita_id',
        'nama_attribute',
        'keterangan',
        'tipe_konten',
        'konten_teks',
        'konten_gambar'
    ];

    // Relasi ke tabel list_beritas
    public function listBerita()
    {
        return $this->belongsTo(ListBerita::class, 'list_berita_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
