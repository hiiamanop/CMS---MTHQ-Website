<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKeamanan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'program_keamanans';

    // Kolom yang dapat diisi
    protected $fillable = [
        'section_id',
        'nama_attribute',
        'tipe_konten',
        'konten_teks',
        'konten_gambar',
    ];

    // Relasi ke tabel 'sections'
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
