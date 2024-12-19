<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'berandas';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'section_id',
        'nama_attribute',
        'keterangan',
        'tipe_konten',
        'konten_teks',
        'konten_gambar'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
