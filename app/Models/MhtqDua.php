<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhtqDua extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id', 
        'nama_attribute', 
        'tipe_konten',
        'konten_teks',
        'konten_gambar'
    ];

    // Definisikan relasi dengan model Section
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
