<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKeamanan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'program_keamanans';

    // Kolom yang dapat diisi (mass assignment)
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
