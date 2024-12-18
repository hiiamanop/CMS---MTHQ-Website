<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangMhtqPimpinan extends Model
{
    use HasFactory;

    protected $table = 'tentang_mhtq_pimpinans';

    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
