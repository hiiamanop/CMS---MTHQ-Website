<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKesehatan extends Model
{
    use HasFactory;

    protected $table = 'program_kesehatans';

    // Mass Assignment
    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
