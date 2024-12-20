<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanSantri extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'kegiatan_santris';

    // Tentukan field yang dapat diisi (mass assignable)
    protected $fillable = [
        'section_id', // Relasi dengan tabel sections
        'nama_attribute',
        'tipe_konten',
        'konten_teks',
        'konten_gambar'
    ];

    // Tentukan relasi dengan model Section
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
