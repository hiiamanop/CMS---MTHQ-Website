<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhtqFasilitas extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'mhtq_fasilitass';

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'section_id', 
        'nama_attribute',
        'tipe_konten',
        'konten_teks',
        'konten_gambar'
    ];

    // Menentukan kolom yang tidak bisa diubah
    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
