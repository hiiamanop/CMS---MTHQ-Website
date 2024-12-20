<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListBerita extends Model
{
    use HasFactory;

    // Table name (optional, jika sesuai konvensi bisa dihapus)
    protected $table = 'list_beritas';

    // Mass assignable attributes
    protected $fillable = [
        'section_id',
        'kategori_berita',
        'judul_berita',
        'tanggal_upload',
        'highlight_berita',
        'tipe_konten',
        'konten_teks',
        'konten_gambar',
    ];

    /**
     * Relasi ke tabel 'sections'.
     * 
     * @return BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
