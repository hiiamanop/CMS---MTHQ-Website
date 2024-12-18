<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramPengasuhan extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika mengikuti konvensi Laravel)
    protected $table = 'program_pengasuhans';

    // Kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
