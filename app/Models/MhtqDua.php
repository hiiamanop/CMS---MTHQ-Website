<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhtqDua extends Model
{
    use HasFactory;

    // Specify the table name (optional if following naming convention)
    protected $table = 'mhtq_duas';

    // Specify the fillable fields
    protected $fillable = ['nama_attribute', 'keterangan'];
}
