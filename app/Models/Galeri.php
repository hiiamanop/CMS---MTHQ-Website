<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'galeris';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'section_id',
        'nama_attribute',
        'jenis_galeri',
        'keterangan',
        'tipe_konten',
        'konten_teks',
        'konten_gambar'
    ];

    // Opsi enum jenis galeri
    public static function getJenisGaleriOptions()
    {
        return ['kegiatan_santri', 'program_pendidikan', 'wisuda_akbar'];
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
