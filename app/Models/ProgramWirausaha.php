<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramWirausaha extends Model
{
    use HasFactory;

    protected $table = 'program_wirausahas'; // Nama tabel

    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
