<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KalenderAkademik extends Model
{
    use HasFactory;

    protected $table = 'kalender_akademiks';

    // Fields yang bisa diisi
    protected $fillable = [
        'nama_attribute',
        'gambar',
    ];
}
