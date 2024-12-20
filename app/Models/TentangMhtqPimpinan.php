<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangMhtqPimpinan extends Model
{
    use HasFactory;

    protected $table = 'tentang_mhtq_pimpinans';

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
