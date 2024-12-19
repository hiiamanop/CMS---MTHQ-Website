<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhtqKeunggulan extends Model
{
    use HasFactory;

    // Define the table explicitly (optional)
    protected $table = 'mhtq_keunggulans';

    // Define fillable fields to allow mass assignment
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
