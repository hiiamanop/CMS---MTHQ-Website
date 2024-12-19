<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBahasa extends Model
{
    use HasFactory;

    protected $table = 'program_bahasas';

    // Tentukan kolom yang bisa diisi (fillable)
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
        return $this->belongsTo(Section::class);
    }
}
