<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramOlahraga extends Model
{
    use HasFactory;

    protected $table = 'program_olahragas';

    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
