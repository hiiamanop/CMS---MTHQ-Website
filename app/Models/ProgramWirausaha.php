<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramWirausaha extends Model
{
    use HasFactory;

    protected $table = 'program_wirausahas'; // Nama tabel

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
