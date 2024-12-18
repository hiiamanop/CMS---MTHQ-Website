<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangMhtqProfile extends Model
{
    use HasFactory;

    protected $table = 'tentang_mhtq_profiles';

    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
