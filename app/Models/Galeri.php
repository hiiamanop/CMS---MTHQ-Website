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
        'nama_attribute',
        'jenis_galeri',
        'keterangan',
        'gambar',
    ];

    // Opsi enum jenis galeri
    public static function getJenisGaleriOptions()
    {
        return ['kegiatan_santri', 'program_pendidikan', 'wisuda_akbar'];
    }
}
