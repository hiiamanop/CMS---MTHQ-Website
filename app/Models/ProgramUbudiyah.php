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
        'nama_attribute',
        'keterangan',
    ];
}
