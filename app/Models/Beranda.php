<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'berandas';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
