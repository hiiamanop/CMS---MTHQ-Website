<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKesehatan extends Model
{
    use HasFactory;

    protected $table = 'program_kesehatans';

    protected $fillable = [
        'section_id',
        'nama_attribute',
        'tipe_konten',
        'konten_teks',
        'konten_gambar',
    ];

    /**
     * Relationship with Section model
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
