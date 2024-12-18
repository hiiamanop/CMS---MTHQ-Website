<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangMhtqPendiri extends Model
{
    use HasFactory;

    protected $table = 'tentang_mhtq_pendiris'; // Nama tabel

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
