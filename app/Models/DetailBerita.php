<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBerita extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_berita_id',
        'nama_attribute',
        'keterangan',
    ];

    // Relasi ke tabel list_beritas
    public function listBerita()
    {
        return $this->belongsTo(ListBerita::class, 'list_berita_id');
    }
}
