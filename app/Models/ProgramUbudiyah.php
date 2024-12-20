<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramUbudiyah extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'program_ubudiyahs';

    // Kolom yang dapat diisi
    protected $fillable = [
        'section_id', 
        'nama_attribute',
        'tipe_konten',
        'konten_teks',
        'konten_gambar'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
