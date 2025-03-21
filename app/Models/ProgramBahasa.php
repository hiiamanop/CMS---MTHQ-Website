<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBahasa extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'nama_attribute',
        'tipe_konten',
        'konten_teks',
        'konten_gambar',
    ];

    /**
     * Get the section that owns the ProgramBahasa.
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
