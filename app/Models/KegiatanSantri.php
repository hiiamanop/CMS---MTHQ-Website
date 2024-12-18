<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanSantri extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_santris';

    // Field yang bisa diisi
    protected $fillable = ['nama_attribute', 'keterangan'];
}