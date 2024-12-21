<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramEkstrakurikuler extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'program_ekstrakurikulers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id',
        'nama_attribute',
        'tipe_konten',
        'konten_teks',
        'konten_gambar',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tipe_konten' => 'string',
    ];

    /**
     * Get the section associated with the program ekstrakurikuler.
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
