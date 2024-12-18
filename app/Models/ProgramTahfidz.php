<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramTahfidz extends Model
{
    use HasFactory;

    protected $table = 'program_tahfidzs';

    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
