<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhtqKeunggulan extends Model
{
    use HasFactory;

    // Define the table explicitly (optional)
    protected $table = 'mhtq_keunggulans';

    // Define fillable fields to allow mass assignment
    protected $fillable = [
        'nama_attribute',
        'keterangan',
    ];
}
